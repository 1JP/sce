<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UpdatePlanSubscription extends Mailable
{
    use Queueable, SerializesModels;

    private string $email;
    private string $plan;
    private string $old_plan;
    private string $value;
    private string $old_value;
    private int $number_film;
    private int $number_serie;
    private int $number_book;

    /**
     * Create a new message instance.
     */
    public function __construct(string $email, string $plan, string $old_plan, string $value, string $old_value, int $number_film, int $number_serie, int $number_book)
    {
        $this->email = $email;
        $this->plan = $plan;
        $this->old_plan = $old_plan;
        $this->value = $value;
        $this->old_value = $old_value;
        $this->number_film = $number_film;
        $this->number_serie = $number_serie;
        $this->number_book = $number_book;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Sua assinatura foi alterado com sucesso!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.update-plan-subscriptions',
            with:[
                'email' => $this->email,
                'plan' => $this->plan,
                'old_plan' => $this->old_plan,
                'value' =>  $this->value,
                'old_value' => $this->old_value,
                'number_film' => $this->number_film,
                'number_serie' => $this->number_serie,
                'number_book' => $this->number_book
            ],
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
