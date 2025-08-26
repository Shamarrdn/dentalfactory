<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultSettings = [
            [
                'key' => 'company_address',
                'value' => '123 شارع الصناعة، المنطقة الصناعية، الرياض، المملكة العربية السعودية',
                'type' => 'textarea',
                'group' => 'general',
                'label' => 'عنوان الشركة',
                'description' => 'العنوان الكامل للشركة',
                'sort_order' => 1,
            ],
            [
                'key' => 'google_maps_url',
                'value' => '',
                'type' => 'url',
                'group' => 'general',
                'label' => 'رابط Google Maps',
                'description' => 'رابط الموقع على خرائط Google',
                'sort_order' => 2,
            ],
            [
                'key' => 'embedded_map_code',
                'value' => '',
                'type' => 'textarea',
                'group' => 'general',
                'label' => 'كود الخريطة التفاعلية (iFrame)',
                'description' => 'كود HTML للخريطة التفاعلية من Google Maps',
                'sort_order' => 3,
            ],
            [
                'key' => 'company_phone',
                'value' => '+966 11 234 5678',
                'type' => 'text',
                'group' => 'general',
                'label' => 'رقم هاتف الشركة',
                'description' => 'رقم الهاتف الرئيسي للشركة',
                'sort_order' => 4,
            ],
            [
                'key' => 'company_email',
                'value' => 'info@dentalproducts.com',
                'type' => 'email',
                'group' => 'general',
                'label' => 'البريد الإلكتروني للشركة',
                'description' => 'البريد الإلكتروني الرسمي للشركة',
                'sort_order' => 5,
            ],
            [
                'key' => 'company_website',
                'value' => '',
                'type' => 'url',
                'group' => 'general',
                'label' => 'موقع الشركة الإلكتروني',
                'description' => 'رابط الموقع الإلكتروني الرسمي للشركة',
                'sort_order' => 6,
            ],
        ];

        foreach ($defaultSettings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
