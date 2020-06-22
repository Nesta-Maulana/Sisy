<?php

namespace App\Models\Transaction\Rollie;

use Illuminate\Database\Eloquent\Model;
use App\Models\ResourceModel;

class FollowUpRkj extends ResourceModel
{
    protected $connection   = 'transaction_data';
    protected $table        = 'follow_up_rkjs';
    protected $guarded      = ['id'];
    public static function boot()
    {
        parent::boot();
    }
    public function rkj()
    {
        return $this->belongsTo('App\Models\Transaction\Rollie\Rkj', 'rkj_id', 'id');
    }

    public function correctiveActions()
    {
        return $this->hasMany('App\Models\Transaction\Rollie\CorrectiveAction', 'follow_up_rkj_id', 'id');
    }

    public function preventiveActions()
    {
        return $this->hasMany('App\Models\Transaction\Rollie\PreventiveAction', 'follow_up_rkj_id', 'id');
    }
}
