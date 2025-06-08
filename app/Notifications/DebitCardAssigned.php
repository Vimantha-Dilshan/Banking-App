<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DebitCardAssigned extends Notification
{
    use Queueable;

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Debit Card Assigned Successfully')
            ->view('emails.debit-card.card-assign-successfully', [
                'customer' => $notifiable,
            ]);
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Debit Card Assigned Successfully',
            'sent_at' => now(),
        ];
    }
}
