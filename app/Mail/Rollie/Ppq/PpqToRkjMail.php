<?php

namespace App\Mail\Rollie\Ppq;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PpqToRkjMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($rkj)
    {
        $this->rkj  = $rkj;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $rkj        = $this->rkj;
        return $this->view('rollie.mail.ppq.ppq-to-rkj',['rkj'=>$this->rkj])->subject('Rollie - RKJ | '.$rkj->nomor_rkj.' | ' . $rkj->ppq->palets[0]->palet->cppDetail->woNumber->product->product_name . ' | '.$rkj->ppq->alasan);
    }
}
