<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class sendSubscriptionConfirmNotification extends Notification
{
    use Queueable;

    public $hash;

    /**
     * Create a new notification instance.
     */
    public function __construct($hash)
    {
        $this->hash = $hash;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Activar suscripción a ' . config('app.name'))
            ->line('Hemos recibido correctamente tu solicitud para suscribirte el Newsletter de ' .
                config('app.name') . '. Puedes activar tu suscripción haciendo click en el siguiente botón:')
            ->action('Activar suscripción', route('activar.suscripcion', $this->hash))
            ->line('Si no activas tu solicitud de suscripción, ésta será eliminada en un periodo de 30
                   días. Si tú no has solicitado esta suscripción, simplemente omite este correo, ya que eliminaremos
                   la solicitud en el periodo señalado.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
