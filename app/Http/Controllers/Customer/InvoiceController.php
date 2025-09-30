<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceEmail;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get invoice data for the given order
     */
    private function getInvoiceData(Order $order)
    {
        // Ensure the order belongs to the authenticated user
        if ($order->user_id !== Auth::id()) {
            abort(403, 'غير مسموح لك بالوصول لهذه الفاتورة');
        }

        // Load relationships
        $order->load(['items.product.images', 'user']);

        // Calculate totals
        $subtotal = $order->items->sum('subtotal');
        $totalTax = 0;
        
        foreach ($order->items as $item) {
            if ($item->product->hasTax()) {
                $itemTax = ($item->subtotal * $item->product->tax_rate) / (100 + $item->product->tax_rate);
                $totalTax += $itemTax;
            }
        }

        return [
            'order' => $order,
            'subtotal' => $subtotal,
            'totalTax' => $totalTax,
            'finalTotal' => $order->total_amount,
            'customer' => $order->user,
            'items' => $order->items,
            'storeInfo' => [
                'name' => 'Genodent',
                'logo' => '<img src="' . url('logo.png') . '" alt="Genodent" style="height: 60px; width: auto;">',
                'address' => 'المملكة العربية السعودية',
                'phone' => '+966 54 411 7002',
                'email' => 'Genodent.1@gmail.com',
                'email2' => 'Genodent.2@gmail.com',
                'whatsapp' => '+966 54 411 7002',
                'website' => 'www.genodent.com'
            ]
        ];
    }

    /**
     * Display the invoice view
     */
    public function view($uuid)
    {
        $order = Order::where('uuid', $uuid)->firstOrFail();
        $invoiceData = $this->getInvoiceData($order);
        
        return view('customer.invoices.template', $invoiceData);
    }

    /**
     * Send invoice by email to the customer
     */
    public function sendByEmail(Request $request, $uuid)
    {
        try {
            $order = Order::where('uuid', $uuid)->firstOrFail();
            $invoiceData = $this->getInvoiceData($order);
            
            // Check if user email is valid
            if (!$order->user || !$order->user->email || $order->user->email === 'customer@example.com') {
                Log::warning('Invalid email for invoice sending', [
                    'order_id' => $order->id,
                    'email' => $order->user ? $order->user->email : 'null'
                ]);
                
                return response()->json([
                    'success' => false,
                    'message' => 'عذراً، لا يوجد بريد إلكتروني صحيح مرتبط بحسابك. يرجى تحديث بياناتك الشخصية.'
                ], 400);
            }

            // Check if mail is configured (not using log driver)
            if (config('mail.default') === 'log') {
                Log::info('Mail driver is set to log, simulating email send', [
                    'order_id' => $order->id,
                    'email' => $order->user->email
                ]);
                
                return response()->json([
                    'success' => true,
                    'message' => 'تم حفظ الفاتورة في سجلات النظام (وضع التطوير)'
                ]);
            }
            
            // Generate PDF
            $pdf = Pdf::loadView('customer.invoices.template', $invoiceData)
                ->setPaper('a4', 'portrait')
                ->setOptions([
                    'defaultFont' => 'Arial',
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'dpi' => 150,
                    'defaultPaperSize' => 'a4',
                    'chroot' => public_path()
                ]);

            // Save PDF temporarily
            $fileName = 'invoice-' . $order->order_number . '.pdf';
            $pdfPath = storage_path('app/temp/' . $fileName);
            
            // Create temp directory if it doesn't exist
            if (!file_exists(dirname($pdfPath))) {
                mkdir(dirname($pdfPath), 0755, true);
            }
            
            $pdf->save($pdfPath);

            // Send email
            Mail::to($order->user->email)->send(new InvoiceEmail($order, $pdfPath));

            // Delete temporary file
            if (file_exists($pdfPath)) {
                unlink($pdfPath);
            }

            Log::info('Invoice sent successfully', [
                'order_id' => $order->id,
                'email' => $order->user->email
            ]);

            return response()->json([
                'success' => true,
                'message' => 'تم إرسال الفاتورة إلى إيميلك بنجاح'
            ]);

        } catch (\Exception $e) {
            Log::error('Customer Invoice Email Error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء إرسال الفاتورة. يرجى المحاولة مرة أخرى أو التواصل مع الدعم الفني.'
            ], 500);
        }
    }

    /**
     * Get invoice data as JSON
     */
    public function getData($uuid)
    {
        $order = Order::where('uuid', $uuid)->firstOrFail();
        $invoiceData = $this->getInvoiceData($order);
        
        return response()->json($invoiceData);
    }
}
