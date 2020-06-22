<?php

namespace App\Mail\Rollie\Rkj;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FollowUpRkjMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($followUpRkj,$params,$params_update = '')
    {
        $this->followUpRkj  = $followUpRkj;
        $this->params       = $params;
        $this->params_update       = $params_update;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $followUpRkj        = $this->followUpRkj;
        $params             = $this->params;
        if ($this->params_update !== '') {
            $params_update = 'UPDATE ';
        }
        else
        {
            $params_update = '';
        }
        if (strpos($params,'rkj-rnd-produk') !== false) 
        {
            return $this->view('rollie.mail.rkj.follow-up-rkj-rnd-produk',['followUpRkj'=>$followUpRkj])->subject('Rollie - '.$params_update.'Follow Up RKJ | '.$followUpRkj->rkj->nomor_rkj . ' | ' . $followUpRkj->rkj->ppq->palets[0]->palet->cppDetail->woNumber->product->product_name . ' | ' . $followUpRkj->rkj->ppq->alasan );
            
        } else 
        {
            return $this->view('rollie.mail.rkj.follow-up-rkj-qa',['followUpRkj'=>$followUpRkj])->subject('Rollie - '.$params_update.'Follow Up RKJ by QA | '.$followUpRkj->rkj->nomor_rkj . ' | ' . $followUpRkj->rkj->ppq->palets[0]->palet->cppDetail->woNumber->product->product_name . ' | ' . $followUpRkj->rkj->ppq->alasan );

        }
        

    }
}
