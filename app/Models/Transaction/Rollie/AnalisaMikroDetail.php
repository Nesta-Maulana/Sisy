<?php

namespace App\Models\Transaction\Rollie;

use Illuminate\Database\Eloquent\Model;
use App\Models\ResourceModel;

class AnalisaMikroDetail extends ResourceModel
{
    protected $connection   = 'transaction_data';
    protected $table        = 'analisa_mikro_details';
    protected $guarded      = ['id'];
    public static function boot()
    {
        parent::boot();
    }
    public function analisaMikroHead()
    {
        return $this->belongsTo('App\Models\Transaction\Rollie\AnalisaMikro', 'analisa_mikro_id', 'id');
    }
    
    public function rpdFillingDetail()
    {
        return $this->belongsTo('App\Models\Transaction\Rollie\RpdFillingDetail', 'rpd_filling_detail_id', 'id');
    }
    
    public function fillingMachine()
    {
        return $this->belongsTo('App\Models\Master\FillingMachine', 'filling_machine_id', 'id');
    }
}
