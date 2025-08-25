<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class InvoiceEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $order;
    private $pdfContent;
    private $filename;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order, $pdfContent, $filename)
    {
        $this->order = $order;
        $this->pdfContent = $pdfContent;
        $this->filename = $filename;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'فاتورة الطلب #' . $this->order->order_number . ' - مصنع منتجات الأسنان',
            from: config('mail.from.address'),
            replyTo: config('mail.from.address')
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.invoice',
            with: [
                'order' => $this->order,
                'customerName' => $this->order->user ? $this->order->user->name : 'عزيزي العميل',
                'orderNumber' => $this->order->order_number,
                'orderDate' => $this->order->created_at->format('Y-m-d'),
                'totalAmount' => number_format($this->order->total_amount, 2)
            ]
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => $this->pdfContent, $this->filename)
                ->withMime('application/pdf')
        ];
    }
}
