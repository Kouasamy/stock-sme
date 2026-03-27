<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StockAdviceEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $tip;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, string $tip)
    {
        $this->user = $user;
        $this->tip = $tip;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '💡 Votre conseil de gestion de stock du jour',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.stock.advice',
        );
    }
}
