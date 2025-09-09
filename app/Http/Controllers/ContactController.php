<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        // Get settings data for contact page
        $settings = [
            'company_address' => Setting::get('company_address', ''),
            'company_phone' => Setting::get('company_phone', ''),
            'company_email' => Setting::get('company_email', ''),
            'company_website' => Setting::get('company_website', ''),
            'google_maps_url' => Setting::get('google_maps_url', ''),
            'embedded_map_code' => Setting::get('embedded_map_code', ''),
        ];

        return view('contact', compact('settings'));
    }
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            // Get company email from settings
            $companyEmail = Setting::get('company_email', 'ahmeddfathy087@gmail.com');
            Mail::to($companyEmail)->send(new ContactFormMail($validated));
            return redirect()->back()->with('success', 'تم إرسال رسالتك بنجاح! سنتواصل معك قريباً.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'عذراً، حدث خطأ أثناء إرسال الرسالة. يرجى المحاولة مرة أخرى.')->withInput();
        }
    }
}
