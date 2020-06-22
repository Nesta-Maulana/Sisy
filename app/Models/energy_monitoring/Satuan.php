<?php

namespace App\Models\energy_monitoring;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $connection = 'energy_monitoring';
    protected $table = "satuan";
    protected $guarded = ['id'];

}
