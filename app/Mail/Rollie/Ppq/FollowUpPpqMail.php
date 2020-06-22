<?php

namespace App\Mail\Rollie\Ppq;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FollowUpPpqMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($followUpPpq,$params,$params_update ='')
    {
        $this->followUpPpq      = $followUpPpq;
        $this->params           = $params;
        $this->params_update    = $params_update;
    }

    public function build()
    {
        $followUpPpq        = $this->followUpPpq;
        if ($this->params_update !== '') 
        {
            $params_update = 'Update ';
        }
        else
        {
            $params_update = '';
        }
        switch ($this->params) 
        {
            case 'ppq-qc-release':
                switch ($followUpPpq->ppq->kategoriPpq->jenisPpq->jenis_ppq) 
                {
                    case 'Package Integrity':
                        /* ini email untuk ppq karena pi*/
                        return $this->view('rollie.mail.ppq.follow-up-ppq-pi',['followUpPpq'=>$followUpPpq])->subject('Rollie - '.$params_update.'Follow Up PPQ | '.$followUpPpq->ppq->nomor_ppq . ' | ' . $followUpPpq->ppq->palets[0]->palet->cppDetail->woNumber->product->product_name . ' | ' . $followUpPpq->ppq->alasan );
                    break;
                }       
            break;

            case 'ppq-qc-tahanan':
                switch ($followUpPpq->ppq->kategoriPpq->jenisPpq->jenis_ppq) 
                {
                    case 'Kimia':
                        return $this->view('rollie.mail.ppq.follow-up-ppq-kimia-qc-tahanan',['followUpPpq'=>$followUpPpq])->subject('Rollie - '.$params_update.'Follow Up PPQ | '.$followUpPpq->ppq->nomor_ppq . ' | ' . $followUpPpq->ppq->palets[0]->palet->cppDetail->woNumber->product->product_name . ' | ' . $followUpPpq->ppq->alasan );
                    break;
                }       
            break;

            case 'ppq-engineering':
                return $this->view('rollie.mail.ppq.follow-up-ppq-engineering',['followUpPpq'=>$followUpPpq])->subject('Rollie - '.$params_update.'Follow Up PPQ  by Engineering| '.$followUpPpq->ppq->nomor_ppq . ' | ' . $followUpPpq->ppq->palets[0]->palet->cppDetail->woNumber->product->product_name . ' | ' . $followUpPpq->ppq->alasan );
            break;
        }
    }
}
