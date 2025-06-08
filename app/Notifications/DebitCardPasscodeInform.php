<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DebitCardPasscodeInform extends Notification
{
    use Queueable;

    protected $passcode;

    public function __construct(string $passcode)
    {
        $this->passcode = $passcode;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your Debit Card Passcode')
            ->view('emails.debit-card.card-passcode-inform', [
                'user' => $notifiable,
                'passcode' => $this->passcode,
            ]);
    }

    public function toArray(object $notifiable): array
    {
        return [
            'email_subject' => 'Debit Card Passcode Inform',
            'passcode' => $this->passcode ?? null,
            'sent_at' => now(),
        ];
    }
}
