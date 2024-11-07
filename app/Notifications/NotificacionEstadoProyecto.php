<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NotificacionEstadoProyecto extends Notification
{
    use Queueable;

    protected $proyecto;

    public function __construct($proyecto)
    {
        $this->proyecto = $proyecto;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'proyecto_id' => $this->proyecto->id,
            'nombre' => $this->proyecto->nombre,
            'estado' => $this->proyecto->estado,
            'mensaje' => 'El estado del proyecto "' . $this->proyecto->nombre . '" ha cambiado a "' . $this->proyecto->estado . '".',
        ];
    }
}

