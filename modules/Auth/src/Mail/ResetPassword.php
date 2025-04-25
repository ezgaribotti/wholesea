<?php

namespace Modules\Auth\src\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public string $link)
    {
    }

    public function envelope(): object
    {
        return new Envelope(subject: 'Reset your password');
    }

    public function content(): object
    {
        return new Content(
            view: 'auth::emails.reset-password',
            with: [
                'link' => $this->link,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
