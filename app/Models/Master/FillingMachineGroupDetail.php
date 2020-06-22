<?php

namespace App\Models\Master;
use App\Models\ResourceModel;
use Illuminate\Database\Eloquent\Model;

class FillingMachineGroupDetail extends ResourceModel
{
    protected $connection   = 'master_data';
    protected $table        = 'filling_machine_group_details';
    protected $guarded      = ['id'];

    public static function boot()
    {
        parent::boot();
    }
    public function fillingMachine()
    {
        return $this->belongsTo('App\Models\Master\FillingMachine', 'filling_machine_id', 'id');
    }
    public function fillingMachineHead()
    {
        return $this->belongsTo('App\Models\Master\FillingMachineGroupHead', 'filling_machine_group_head_id', 'id');
    }
}
