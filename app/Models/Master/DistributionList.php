<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use App\Models\ResourceModel;

class DistributionList extends ResourceModel
{
	protected $connection 	= 'master_data';
	protected $guarded 		= ['id'];
    protected $table 		= 'distribution_lists';
    public  static function boot()
    {
        parent::boot();
    }
    
    public function employee()
    {
        return $this->belongsTo('App\Models\Master\Employee');
    }

}
