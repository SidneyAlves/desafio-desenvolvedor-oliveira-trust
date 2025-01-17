<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use app\Models\Exchange;

class SendExchange extends Mailable
{
    use Queueable, SerializesModels;
    public $exchange;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $exchange)
    {
        $this->exchange = $exchange;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Sua simulação de conversão',
        );
    }

    /**
     * Get the message content definition.
     *'
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'email.exchange',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
