<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\InvoiceEmail;

class InvoiceController extends Controller
{
    /**
     * Display invoice in browser
     */
    public function view($uuid)
    {
        try {
            $order = Order::where('uuid', $uuid)
                ->with(['user', 'items.product', 'items.product.category', 'address', 'phoneNumber'])
                ->firstOrFail();

            return view('admin.invoices.template', compact('order'));
        } catch (\Exception $e) {
            Log::error('Error displaying invoice: ' . $e->getMessage());
            return back()->with('error', 'حدث خطأ أثناء عرض الفاتورة');
        }
    }

    /**
     * Download invoice as PDF
     */
    public function download($uuid)
    {
        try {
            $order = Order::where('uuid', $uuid)
                ->with(['user', 'items.product', 'items.product.category', 'address', 'phoneNumber'])
                ->firstOrFail();

            $pdf = Pdf::loadView('admin.invoices.template', compact('order'))
                ->setPaper('a4', 'portrait')
                ->setOptions([
                    'defaultFont' => 'DejaVu Sans',
                    'isRemoteEnabled' => true,
                    'isHtml5ParserEnabled' => true,
                    'isPhpEnabled' => true
                ]);

            $filename = 'invoice-' . $order->order_number . '.pdf';
            
            return $pdf->download($filename);
        } catch (\Exception $e) {
            Log::error('Error downloading invoice: ' . $e->getMessage());
            return back()->with('error', 'حدث خطأ أثناء تحميل الفاتورة');
        }
    }

    /**
     * Send invoice by email to customer
     */
    public function sendByEmail($uuid)
    {
        try {
            $order = Order::where('uuid', $uuid)
                ->with(['user', 'items.product', 'items.product.category', 'address', 'phoneNumber'])
                ->firstOrFail();

            // Check if customer has email
            if (!$order->user || !$order->user->email) {
                return response()->json([
                    'success' => false,
                    'message' => 'لا يوجد بريد إلكتروني للعميل'
                ], 400);
            }

            // Generate PDF
            $pdf = Pdf::loadView('admin.invoices.template', compact('order'))
                ->setPaper('a4', 'portrait')
                ->setOptions([
                    'defaultFont' => 'DejaVu Sans',
                    'isRemoteEnabled' => true,
                    'isHtml5ParserEnabled' => true,
                    'isPhpEnabled' => true
                ]);

            $filename = 'invoice-' . $order->order_number . '.pdf';

            // Send email with PDF attachment
            Mail::to($order->user->email)->send(new InvoiceEmail($order, $pdf->output(), $filename));

            // Log the action
            Log::info('Invoice sent by email', [
                'order_id' => $order->id,
                'customer_email' => $order->user->email,
                'sent_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'تم إرسال الفاتورة بنجاح إلى ' . $order->user->email
            ]);

        } catch (\Exception $e) {
            Log::error('Error sending invoice by email: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء إرسال الفاتورة'
            ], 500);
        }
    }

    /**
     * Get invoice data for API or AJAX requests
     */
    public function getData($uuid)
    {
        try {
            $order = Order::where('uuid', $uuid)
                ->with(['user', 'items.product', 'items.product.category', 'address', 'phoneNumber'])
                ->firstOrFail();

            return response()->json([
                'success' => true,
                'data' => [
                    'order' => $order,
                    'customer' => $order->user,
                    'items' => $order->items,
                    'totals' => [
                        'subtotal' => $order->original_amount,
                        'quantity_discount' => $order->quantity_discount,
                        'coupon_discount' => $order->coupon_discount,
                        'total' => $order->total_amount
                    ]
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting invoice data: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء جلب بيانات الفاتورة'
            ], 500);
        }
    }
}
