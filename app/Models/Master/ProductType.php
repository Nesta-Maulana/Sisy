<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use App\Models\ResourceModel;

class ProductType extends ResourceModel
{
    protected $connection   = 'master_data';
    protected $table        = 'product_types';
    protected $guarded      = ['id'];
    
    public static function boot()
    {
        parent::boot();
    }
    
    public function products()
    {
        return $this->hasMany('App\Models\Master\Product', 'product_type_id', 'id');
    }
}
