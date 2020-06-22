<?php

namespace App\Models\Transaction\Rollie;

use Illuminate\Database\Eloquent\Model;
use App\Models\ResourceModel;
use Illuminate\Database\Eloquent\SoftDeletes;
class RpdFillingDetailPi extends ResourceModel
{
    use softDeletes;
	protected $connection   = 'transaction_data';
    protected $table = 'rpd_filling_detail_pis';
    protected $guarded  = ['id'];
    public static function boot()
    {
        parent::boot();
    }

    
    public function rpdFillingHead()
    {
        return $this->belongsTo('App\Models\Transaction\Rollie\RpdFillingHead', 'rpd_filling_head_id', 'id');
    }
    
    public function woNumber()
    {
        return $this->belongsTo('App\Models\Transaction\Rollie\WoNumber', 'wo_number_id', 'id');
    }
    
    public function fillingMachine()
    {
        return $this->belongsTo('App\Models\Master\FillingMachine', 'filling_machine_id', 'id');
    }
    
    public function fillingSampelCode()
    {
        return $this->belongsTo('App\Models\Master\FillingSampelCode', 'filling_sampel_code_id', 'id');
    }
}
