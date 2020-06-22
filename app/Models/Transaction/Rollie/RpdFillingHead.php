<?php

namespace App\Models\Transaction\Rollie;

use Illuminate\Database\Eloquent\Model;
use App\Models\ResourceModel;

class RpdFillingHead extends ResourceModel
{
	protected $connection   = 'transaction_data';
    protected $table = 'rpd_filling_heads';
    protected $guarded  = ['id'];
    public static function boot()
    {
        parent::boot();
    }
    
    public function product()
    {
        return $this->belongsTo('App\Models\Master\Product', 'product_id', 'id');
    }
    public function woNumbers()
    {
        return $this->hasMany('App\Models\Transaction\Rollie\WoNumber', 'rpd_filling_head_id', 'id');
    }
    public function rpdFillingDetailPis()
    {
        return $this->hasMany('App\Models\Transaction\Rollie\RpdFillingDetailPi', 'rpd_filling_head_id', 'id');
    }
    
    public function rpdFillingDetailAtEvents()
    {
        return $this->hasMany('App\Models\Transaction\Rollie\RpdFillingDetailAtEvent', 'rpd_filling_head_id', 'id');
    }
}
