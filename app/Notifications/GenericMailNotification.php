<?php

namespace App\Notifications;

use App\Mail\GenericMail as Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class GenericMailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $genericMailNotification;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($genericMailNotification)
    {
        $this->genericMailNotification = $genericMailNotification;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new Mailable($this->genericMailNotification))->to($notifiable->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            "subjectInfo" => $this->genericMailNotification->subject,
            "title" => $this->genericMailNotification->title,
            "description" => $this->genericMailNotification->description,
            "button_url" => $this->genericMailNotification->button_url,
            "button_text" => $this->genericMailNotification->button_text,
        ];
    }
}
