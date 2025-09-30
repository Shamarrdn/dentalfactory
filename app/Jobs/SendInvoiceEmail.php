<?php

namespace App\Jobs;

use App\Mail\InvoiceEmail;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

class SendInvoiceEmail implements ShouldQueue
{
    use Queueable;

    protected $order;

    /**
     * Create a new job instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Load order relationships for invoice data
            $this->order->load(['items.product.images', 'user']);

            // Check if user has valid email
            if (!$this->order->user || !$this->order->user->email || $this->order->user->email === 'customer@example.com') {
                Log::warning('Invalid email for invoice sending', [
                    'order_id' => $this->order->id,
                    'email' => $this->order->user ? $this->order->user->email : 'null'
                ]);
                return;
            }

            // Prepare invoice data
            $invoiceData = $this->getInvoiceData($this->order);

            // Generate PDF content
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

            // Get PDF content as string
            $pdfContent = $pdf->output();
            $fileName = 'فاتورة-الطلب-' . $this->order->order_number . '.pdf';

            // Send email with PDF attachment
            Mail::to($this->order->user->email)->send(new InvoiceEmail($this->order, $pdfContent, $fileName));

            Log::info('Invoice sent successfully via background job', [
                'order_id' => $this->order->id,
                'email' => $this->order->user->email
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to send invoice email via background job', [
                'order_id' => $this->order->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
        }
    }

    /**
     * Get invoice data for PDF generation
     */
    private function getInvoiceData(Order $order)
    {
        // Calculate totals
        $subtotal = $order->items->sum('subtotal');
        $totalTax = 0;
        
        foreach ($order->items as $item) {
            if ($item->product && method_exists($item->product, 'hasTax') && $item->product->hasTax()) {
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
}
