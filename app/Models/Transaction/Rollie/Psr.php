<?php

namespace App\Models\Transaction\Rollie;

use Illuminate\Database\Eloquent\Model;
use App\Models\ResourceModel;

class Psr extends ResourceModel
{
	protected $connection   = 'transaction_data';
    protected $table        = 'psrs';
    protected $guarded      = ['id'];
    public static function boot()
    {
        parent::boot();
    }
    
    public function woNumber()
    {
        return $this->belongsTo('App\Models\Transaction\Rollie\WoNumber', 'wo_number_id', 'id');
    }
    
}
