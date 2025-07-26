<?php

namespace Modules\Shipments\src\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ShipmentUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public object $shipment)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Shipment updated',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'shipments::emails.shipment-updated',
            with: [
                'shipment_id' => $this->shipment->id,
                'tracking_code' => $this->shipment->tracking_code,
                'status' => strtoupper($this->shipment->trackingStatus->name),
                'date' => $this->shipment->updated_at,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
