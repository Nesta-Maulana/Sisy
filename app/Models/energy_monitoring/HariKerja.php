<?php

namespace App\Models\energy_monitoring;

use Illuminate\Database\Eloquent\Model;

class HariKerja extends Model
{
 	protected $connection = 'energy_monitoring';
    protected $table = "hari_kerja";
    protected $guarded = ['id'];
}
