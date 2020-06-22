<?php

namespace App\Mail\Rollie\AnalisaMikro;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationToQCRelease extends Mailable
{
    use Queueable, SerializesModels;

     /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($analisaMikro,$keterangan,$subject)
    {
        $this->analisaMikro     = $analisaMikro;
        $this->keterangan       = $keterangan;
        $this->subject          = $subject;
    }

    public function build()
    {
        $analisaMikro           = $this->analisaMikro;
        $keterangan             = $this->keterangan;
        $subject                = $this->subject;
        return $this->view('rollie.mail.analisa_mikro.notification-to-qc-release',['analisaMikro'=>$analisaMikro,'keterangan'=>$keterangan,'subject' => $subject])->subject($subject);
    }
}
