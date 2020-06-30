<?php

namespace App\Mail\Rollie\Psr;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendNotifPsr extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($psr_array)
    {
        $this->psr_array    = $psr_array;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $psr_array  = $this->psr_array;
        $update     = date('Y-m-d');
        return $this->view('rollie.mail.psr.notif-to-penyelia')->subject("Update PSR tanggal ".$update)->with(['psrs'=>$psr_array]);
    }
}
