<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use App\Models\ResourceModel;
class FillingMachine extends ResourceModel
{
    
    protected $connection   = 'master_data';
    protected $table        = 'filling_machines';
    protected $guarded      = ['id'];
    public static function boot()
    {
        parent::boot();
    }
    public function fillingMachineGroupHead()
    {
        return $this->hasMany('App\Models\Master\FillingMachineGroupHead', 'filling_machine_id', 'id');
    }
    
    public function fillingMachineGroupDetail()
    {
        return $this->hasMany('App\Models\Master\FillingMachineGroupDetail', 'filling_machine_id', 'id');
    }
}
