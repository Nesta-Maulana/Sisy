<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use App\Models\ResourceModel;

class Subbrand extends ResourceModel
{
    protected $connection   = 'master_data';
    protected $table        = 'subbrands';
    protected $guarded      = ['id'];
    
    public static function boot()
    {
        parent::boot();
    }

    public function products()
    {
        return $this->hasMany('App\Models\Master\Product', 'subbrand_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Master\Brand', 'brand_id', 'id');
    }
}
