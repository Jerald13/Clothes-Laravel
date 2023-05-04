<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
// use Illuminate\Notifications\Messages\NexmoMessage;

use Illuminate\Notifications\Messages\VonageMessage;
// use Notification;
use Illuminate\Notifications\Notification;

// class MyNotification extends Notification
class MyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    // public function via(object $notifiable): array
    // {
    //     // return ["mail", "vonage"];
    //     return ["vonage"];
    // }

    public function via($notifiable)
    {
        return ["vonage"];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage())
            ->line("The introduction to the notification.")
            ->action("Notification Action", url("/"))
            ->line("Thank you for using our application!");
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

    // public function toNextmo($notifiable)
    // {
    //     return (new NexmoMessage())->content("What the Fuck, kinda dope bro");
    // }

    public function toVonage(object $notifiable): VonageMessage
    {
        return (new VonageMessage())
            ->content("Payment Successfully")
            ->clientReference($notifiable->phone_number);
    }
}
