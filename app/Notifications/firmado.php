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
        $firmaAdmin = asset('storage/adminFirma/'.collect(\File::allFiles(public_path('storage/adminFirma/')))->reverse()->first()->getRelativePathname());
        
        $pdf = PDF::loadView('pdf.contrato', ['inversion' => $this->inversor, 'firmaAdmin' => $firmaAdmin]);

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

    public function mostrar_imagenes($ruta)
    {
         // Se comprueba que realmente sea la ruta de un directorio
        if (is_dir($ruta)){
            // Abre un gestor de directorios para la ruta indicada
            $gestor = opendir($ruta);
            echo "<ul>";

            // Recorre todos los elementos del directorio
            while (($archivo = readdir($gestor)) !== false)  {
                    
                $ruta_completa = $ruta . "/" . $archivo;
            
                // Se muestran todos los archivos y carpetas excepto "." y ".."
                if ($archivo != "." && $archivo != "..") {
                    // Si es un directorio se recorre recursivamente
                    closedir($gestor);
                    return $ruta_completa;
                   
                }
            }
        } else {
            echo "No es una ruta de directorio valida<br/>";
        }
    }
}
