<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FirebaseNotificationService
{
    private $credentials;
    private $accessToken;
    private $projectId = 'dental-factory-95a8a';
    private $tokenExpiry = 0;

    public function __construct()
    {
        $firebaseKey = file_get_contents(storage_path('app/firebase/dental-factory-95a8a-firebase-adminsdk-fbsvc-7665f341fa.json'));
        $this->credentials = json_decode($firebaseKey, true);
    }

    public function sendNotification(string $fcmToken, string $title, string $body, string $link = '/test')
    {
        try {
            Log::info('Starting to send notification', [
                'token' => $fcmToken,
                'title' => $title,
                'body' => $body,
                'link' => $link
            ]);

            if (!$this->accessToken || time() >= $this->tokenExpiry) {
                Log::info('Getting new access token');
                $this->accessToken = $this->getAccessToken();
            }

            $payload = [
                'message' => [
                    'token' => $fcmToken,
                    'notification' => [
                        'title' => $title,
                        'body' => $body
                    ],
                    'webpush' => [
                        'headers' => [
                            'Urgency' => 'high'
                        ],
                        'notification' => [
                            'title' => $title,
                            'body' => $body,
                            'vibrate' => [100, 50, 100],
                            'requireInteraction' => true,
                            'dir' => 'rtl',
                            'lang' => 'ar',
                            'tag' => 'notification'
                        ],
                        'fcm_options' => [
                            'link' => $link
                        ]
                    ]
                ]
            ];

            Log::info('Sending FCM request with payload', [
                'payload' => $payload
            ]);

            $maxRetries = 3;
            $retryDelay = 2;

            for ($attempt = 1; $attempt <= $maxRetries; $attempt++) {
                try {
                    Log::info("FCM attempt {$attempt} of {$maxRetries}");

                    $response = Http::timeout(30)
                        ->withHeaders([
                            'Authorization' => 'Bearer ' . $this->accessToken,
                            'Content-Type' => 'application/json'
                        ])
                        ->post("https://fcm.googleapis.com/v1/projects/{$this->projectId}/messages:send", $payload);

                    Log::info('FCM response received', [
                        'attempt' => $attempt,
                        'status' => $response->status(),
                        'body' => $response->json()
                    ]);

                    if ($response->successful()) {
                        Log::info('FCM notification sent successfully', [
                            'attempt' => $attempt,
                            'status' => $response->status()
                        ]);
                    }

                    return [
                        'success' => $response->successful(),
                        'message' => $response->json()
                    ];

                } catch (\Exception $e) {
                    Log::warning("FCM attempt {$attempt} failed", [
                        'error' => $e->getMessage(),
                        'attempt' => $attempt,
                        'max_retries' => $maxRetries
                    ]);

                    if ($attempt < $maxRetries) {
                        Log::info("Retrying in {$retryDelay} seconds...");
                        sleep($retryDelay);
                        $retryDelay *= 2;
                    } else {
                        Log::error('All FCM attempts failed', [
                            'total_attempts' => $maxRetries,
                            'final_error' => $e->getMessage()
                        ]);
                        throw $e;
                    }
                }
            }

        } catch (\Exception $e) {
            Log::error('Error sending notification', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw $e;
        }
    }

    public function sendNotificationToAdmins(string $title, string $body, string $link = '/admin/dashboard')
    {
        try {
            Log::info('Starting to send notifications to admins');

            // فحص الاتصال بالإنترنت أولاً
            if (!$this->checkInternetConnection()) {
                Log::warning('No internet connection available, skipping notifications');
                return [
                    'success' => false,
                    'message' => 'No internet connection available'
                ];
            }

            // Get all admin users who have FCM tokens
            $admins = User::where('role', 'admin')
                         ->whereNotNull('fcm_token')
                         ->get();

            // Add this debug line
            Log::info('Admin users query', [
                'sql' => User::where('role', 'admin')->whereNotNull('fcm_token')->toSql(),
                'count' => $admins->count(),
                'admins' => $admins->toArray()
            ]);

            Log::info('Found admins with FCM tokens', [
                'count' => $admins->count(),
                'admin_ids' => $admins->pluck('id')->toArray()
            ]);

            $results = [];
            foreach ($admins as $admin) {
                try {
                    Log::info('Sending notification to admin', [
                        'admin_id' => $admin->id,
                        'fcm_token' => $admin->fcm_token
                    ]);

                    $result = $this->sendNotification(
                        $admin->fcm_token,
                        $title,
                        $body,
                        $link
                    );

                    Log::info('Notification sent to admin successfully', [
                        'admin_id' => $admin->id,
                        'result' => $result
                    ]);

                    $results[$admin->id] = $result;
                } catch (\Exception $e) {
                    Log::error("Failed to send notification to admin {$admin->id}", [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString(),
                        'fcm_token' => $admin->fcm_token
                    ]);
                    $results[$admin->id] = [
                        'success' => false,
                        'error' => $e->getMessage()
                    ];
                }
            }

            return [
                'success' => true,
                'results' => $results
            ];

        } catch (\Exception $e) {
            Log::error('Error sending notifications to admins', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw $e;
        }
    }

    /**
     * فحص الاتصال بالإنترنت
     */
    private function checkInternetConnection()
    {
        try {
            $response = Http::timeout(5)->get('https://www.google.com');
            return $response->successful();
        } catch (\Exception $e) {
            Log::warning('Internet connection check failed', [
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    private function getAccessToken()
    {
        try {
            $now = time();
            $payload = [
                'iss' => $this->credentials['client_email'],
                'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
                'aud' => $this->credentials['token_uri'],
                'exp' => $now + 3600,
                'iat' => $now
            ];

            $jwt = $this->generateJWT($payload, $this->credentials['private_key']);

            $maxRetries = 3;
            $retryDelay = 2;

            for ($attempt = 1; $attempt <= $maxRetries; $attempt++) {
                try {
                    $response = Http::timeout(30)
                        ->asForm()
                        ->post($this->credentials['token_uri'], [
                            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                            'assertion' => $jwt
                        ]);

                    if (!$response->successful()) {
                        Log::error('Failed to get access token', [
                            'attempt' => $attempt,
                            'response' => $response->json()
                        ]);

                        if ($attempt < $maxRetries) {
                            Log::info("Retrying token request in {$retryDelay} seconds...");
                            sleep($retryDelay);
                            $retryDelay *= 2;
                            continue;
                        }

                        throw new \Exception('Failed to get access token: ' . $response->body());
                    }

                    $tokenData = $response->json();
                    $this->tokenExpiry = $now + ($tokenData['expires_in'] ?? 3600) - 300;

                    Log::info('Access token obtained successfully', [
                        'expires_in' => $tokenData['expires_in'] ?? 3600,
                        'token_expiry' => $this->tokenExpiry
                    ]);

                    return $tokenData['access_token'];

                } catch (\Exception $e) {
                    Log::warning("Token request attempt {$attempt} failed", [
                        'error' => $e->getMessage(),
                        'attempt' => $attempt
                    ]);

                    if ($attempt < $maxRetries) {
                        Log::info("Retrying token request in {$retryDelay} seconds...");
                        sleep($retryDelay);
                        $retryDelay *= 2;
                    } else {
                        throw $e;
                    }
                }
            }

        } catch (\Exception $e) {
            Log::error('Error getting access token', [
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    private function generateJWT($payload, $privateKey)
    {
        $header = json_encode(['typ' => 'JWT', 'alg' => 'RS256']);
        $payload = json_encode($payload);

        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

        $signatureInput = $base64UrlHeader . "." . $base64UrlPayload;
        openssl_sign($signatureInput, $signature, $privateKey, 'SHA256');
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    }
}
