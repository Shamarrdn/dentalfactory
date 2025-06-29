<?php

namespace App\Http\Controllers;

use App\Mail\HomeFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeFormController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'companyName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'productCategory' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        try {
            Mail::to('ahmeddfathy087@gmail.com')->send(new HomeFormMail($validated));
            return redirect()->back()->with('success', 'تم إرسال طلبك بنجاح! سنتواصل معك قريباً.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'عذراً، حدث خطأ أثناء إرسال الطلب. يرجى المحاولة مرة أخرى.')->withInput();
        }
    }
}
