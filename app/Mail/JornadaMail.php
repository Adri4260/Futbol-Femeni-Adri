<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JornadaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $partits;

    public function __construct($partits)
    {
        $this->partits = $partits;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Resum de la Jornada - Futbol Femení',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.jornada',
            with: [
                'partits' => $this->partits,
            ],
        );
    }
}
