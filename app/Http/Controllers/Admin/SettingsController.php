<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    /**
     * Display the general settings form
     */
    public function general()
    {
        $settings = Setting::group('general')->ordered()->get();
        
        // If no settings exist, create default ones
        if ($settings->isEmpty()) {
            $this->createDefaultSettings();
            $settings = Setting::group('general')->ordered()->get();
        }

        return view('admin.settings.general', compact('settings'));
    }

    /**
     * Update general settings
     */
    public function updateGeneral(Request $request)
    {
        $rules = [
            'company_address' => 'nullable|string|max:500',
            'google_maps_url' => 'nullable|url|max:1000',
            'embedded_map_code' => 'nullable|string|max:5000',
            'company_phone' => 'nullable|string|max:20',
            'company_email' => 'nullable|email|max:100',
            'company_website' => 'nullable|url|max:200',
        ];

        $messages = [
            'company_address.max' => 'عنوان الشركة يجب أن يكون أقل من 500 حرف',
            'google_maps_url.url' => 'رابط Google Maps يجب أن يكون رابط صحيح',
            'google_maps_url.max' => 'رابط Google Maps يجب أن يكون أقل من 1000 حرف',
            'embedded_map_code.max' => 'كود الخريطة يجب أن يكون أقل من 5000 حرف',
            'company_phone.max' => 'رقم الهاتف يجب أن يكون أقل من 20 حرف',
            'company_email.email' => 'البريد الإلكتروني يجب أن يكون صحيح',
            'company_email.max' => 'البريد الإلكتروني يجب أن يكون أقل من 100 حرف',
            'company_website.url' => 'موقع الشركة يجب أن يكون رابط صحيح',
            'company_website.max' => 'موقع الشركة يجب أن يكون أقل من 200 حرف',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update each setting
        foreach ($request->only(array_keys($rules)) as $key => $value) {
            if ($request->has($key)) {
                Setting::set($key, $value, $this->getFieldType($key), 'general', $this->getFieldLabel($key));
            }
        }

        return redirect()->route('admin.settings.general')
            ->with('success', 'تم حفظ الإعدادات بنجاح');
    }

    /**
     * Create default settings
     */
    private function createDefaultSettings()
    {
        $defaultSettings = [
            'company_address' => [
                'value' => '',
                'type' => 'textarea',
                'label' => 'عنوان الشركة',
                'sort_order' => 1,
            ],
            'google_maps_url' => [
                'value' => '',
                'type' => 'url',
                'label' => 'رابط Google Maps',
                'sort_order' => 2,
            ],
            'embedded_map_code' => [
                'value' => '',
                'type' => 'textarea',
                'label' => 'كود الخريطة التفاعلية (iFrame)',
                'sort_order' => 3,
            ],
            'company_phone' => [
                'value' => '',
                'type' => 'text',
                'label' => 'رقم هاتف الشركة',
                'sort_order' => 4,
            ],
            'company_email' => [
                'value' => '',
                'type' => 'email',
                'label' => 'البريد الإلكتروني للشركة',
                'sort_order' => 5,
            ],
            'company_website' => [
                'value' => '',
                'type' => 'url',
                'label' => 'موقع الشركة الإلكتروني',
                'sort_order' => 6,
            ],
        ];

        foreach ($defaultSettings as $key => $data) {
            Setting::create([
                'key' => $key,
                'value' => $data['value'],
                'type' => $data['type'],
                'group' => 'general',
                'label' => $data['label'],
                'sort_order' => $data['sort_order'],
            ]);
        }
    }

    /**
     * Get field type for validation
     */
    private function getFieldType($key)
    {
        $types = [
            'company_address' => 'textarea',
            'google_maps_url' => 'url',
            'embedded_map_code' => 'textarea',
            'company_phone' => 'text',
            'company_email' => 'email',
            'company_website' => 'url',
        ];

        return $types[$key] ?? 'text';
    }

    /**
     * Get field label
     */
    private function getFieldLabel($key)
    {
        $labels = [
            'company_address' => 'عنوان الشركة',
            'google_maps_url' => 'رابط Google Maps',
            'embedded_map_code' => 'كود الخريطة التفاعلية (iFrame)',
            'company_phone' => 'رقم هاتف الشركة',
            'company_email' => 'البريد الإلكتروني للشركة',
            'company_website' => 'موقع الشركة الإلكتروني',
        ];

        return $labels[$key] ?? $key;
    }

    /**
     * Test the embedded map code
     */
    public function testEmbeddedMap(Request $request)
    {
        $request->validate([
            'embedded_map_code' => 'required|string|max:5000',
        ]);

        $mapCode = $request->embedded_map_code;
        
        // Basic validation for iframe
        if (strpos($mapCode, '<iframe') === false) {
            return response()->json([
                'success' => false,
                'message' => 'كود الخريطة يجب أن يحتوي على عنصر iframe'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'كود الخريطة صحيح',
            'preview' => $mapCode
        ]);
    }
}
