<?php

namespace App\Models\Transaction\Rollie;

use Illuminate\Database\Eloquent\Model;
use App\Models\ResourceModel;

class Rkj extends ResourceModel
{
    protected $connection   = 'transaction_data';
    protected $table        = 'rkjs';
    protected $guarded      = ['id'];
    public static function boot()
    {
        parent::boot();
    }
    public function Ppq()
    {
        return $this->belongsTo('App\Models\Transaction\Rollie\Ppq', 'ppq_id', 'id');
    }
    public function followUpRkj()
    {
        return $this->hasOne('App\Models\Transaction\Rollie\FollowUpRkj', 'rkj_id', 'id');
    }
}
