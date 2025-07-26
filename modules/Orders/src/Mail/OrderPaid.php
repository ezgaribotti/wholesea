<?php

namespace Modules\Orders\src\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderPaid extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public object $order, public int $shippingPaid)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order paid',
        );
    }

    public function content(): Content
    {
        $currency = config('common.stripe.currency');

        return new Content(
            view: 'orders::emails.order-paid',
            with: [
                'order_id' => $this->order->id,
                'tracking_code' => $this->order->tracking_code,
                'total_paid' => $this->order->total_amount,
                'shipping_paid' => $this->shippingPaid,
                'currency' => strtoupper($currency),
                'date' => now()->toDateTimeString(),
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
