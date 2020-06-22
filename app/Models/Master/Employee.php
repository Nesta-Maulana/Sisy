<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use App\Models\ResourceModel;
class Employee extends ResourceModel
{
	protected $connection 	= 'master_data';
	protected $guarded 		= ['id'];
    protected $table 		= 'employees';
    public  static function boot()
    {
        parent::boot();
    }
    public function user()
    {
        return $this->belongsTo('App\Models\Master\User', 'employee_id', 'id');
    }
    public function departement()
    {
        return $this->belongsTo('App\Models\Master\Departement', 'employee_id', 'id');
    }
}
