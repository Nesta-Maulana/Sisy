<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
	protected $conntection 	='master_data';
	protected $table 		='plans';
	protected $guarded 		=['id'];
}
