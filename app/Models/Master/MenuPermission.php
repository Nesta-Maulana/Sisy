<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use App\Models\ResourceModel;

class MenuPermission extends ResourceModel
{
	protected $connection 	= 'master_data';
	protected $guarded 		= ['id'];
	protected $table 		= 'menu_permissions';
    public static function boot()
    {
        parent::boot();
    }
    public function menu()
    {
        return $this->belongsTo('App\Models\Master\Menu', 'menu_id','id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\Master\User', 'user_id','id');
    }

}
