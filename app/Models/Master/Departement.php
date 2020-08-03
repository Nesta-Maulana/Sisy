<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use App\Models\ResourceModel;
class Departement extends ResourceModel
{
	protected $connection 	= 'master_data';
	protected $guarded		= ['id'];
	protected $table 		= 'departements';
    public static function boot()
    {
        parent::boot();
    }
    public function employees()
    {
        return $this->hasMany('App\Models\Master\Employee', 'departement_id', 'id');
    }
}
