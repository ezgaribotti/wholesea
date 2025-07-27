<?php

namespace Modules\Shipments\src\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ShipmentPaid extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public object $shipment)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Shipment paid',
        );
    }

    public function content(): Content
    {
        $currency = config('common.stripe.currency');

        return new Content(
            view: 'shipments::emails.shipment-paid',
            with: [
                'shipment_id' => $this->shipment->id,
                'tracking_code' => $this->shipment->tracking_code,
                'currency' => strtoupper($currency),
                'cost' => $this->shipment->cost,
                'date' => $this->shipment->updated_at,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
