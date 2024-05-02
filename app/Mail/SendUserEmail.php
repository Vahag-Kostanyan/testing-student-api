<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendUserEmail extends Mailable
{
    use Queueable, SerializesModels;

    public string|null $email;
    public string|null $password;
    public string|null $domain;

    /**
     * @property string $email
     * @property string $password
     * @property string $domain
     */
    public function __construct(string $email, string $password, string $domain)
    {
        $this->email = $email;
        $this->password = $password;
        $this->domain = $domain;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send User Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.SendUserEmail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
