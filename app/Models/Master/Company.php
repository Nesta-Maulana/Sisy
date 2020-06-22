<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use App\Models\ResourceModel;

class Company extends ResourceModel
{    
    protected $connection   = 'master_data';
    protected $table        = 'companies';
    protected $guarded      = ['id'];
    public static function boot()
    {
        parent::boot();
    }
    public function plans()
    {
        return $this->hasMany('App\Models\Master\Plan', 'company_id', 'id');
    }
    public function brands()
    {
        return $this->hasMany('App\Models\Master\Brand', 'company_id', 'id');
    }
}
