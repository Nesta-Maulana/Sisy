<?php

namespace App\Mail\Rollie\Ppq;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPpqMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ppq)
    {
        $this->ppq  = $ppq;
    }

    /**
     * Build the message.
     *mobilemo
     * @return $this
     */
    public function build()
    {
        $ppq    = $this->ppq;
        return $this->view('rollie.mail.ppq.new-ppq',['ppq'=>$ppq])->subject('Rollie - PPQ | '.$ppq->nomor_ppq . ' | ' . $ppq->palets[0]->palet->cppDetail->woNumber->product->product_name . ' | ' . $ppq->alasan );
    }
}
