<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendUserTestResult extends Mailable
{
    use Queueable, SerializesModels;

    public bool $status;
    public string|null $mark;
    public string|null $username;
    public string|null $testName;

    /**
     * @property string $status
     * @property string $mark
     */
    public function __construct(string $username, string $testName, bool $status, string $mark)
    {
        $this->status = $status;
        $this->mark = $mark;
        $this->username = $username;
        $this->testName = $testName;
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
            view: 'emails.SendUserTestResult',
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
