<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Inversion;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;

class firmado extends Notification
{
    use Queueable;
    public $inversor;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Inversion $inversor)
    {
        //
        $this->inversor = $inversor;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        $pdf = PDF::loadView('pdf.contrato', ['inversion' => $this->inversor]);

        return (new MailMessage)
        ->subject('Firma Exitosa')
        ->view('Mails.firmadoEmail')
        ->attachData($pdf->output(), 'contrato.pdf');
    }
    

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
