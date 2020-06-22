<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use App\Models\ResourceModel;
class FillingSampelCode extends ResourceModel
{
    protected $connection   ='master_data';
    protected $table        ='filling_sampel_codes';
    protected $guarded      = ['id'];

    public static function boot()
    {
        parent::boot();
    }
    public function rpdFillingPiSampels()
    {
        return $this->hasMany('App\Models\Trasaction\Rollie\RpdFillingDetailPi', 'filling_sampel_code_id', 'id');
    }
    
    public function rpdFillingAtEventSampels()
    {
        return $this->hasMany('App\Models\Trasaction\Rollie\RpdFillingDetailAtEvent', 'filling_sampel_code_id', 'id');
    }
    
}
