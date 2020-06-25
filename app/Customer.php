<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'remark_id', 'subscription_type_id', 'subscription_id', 'start_date'];

    public function remark()
    {
        return $this->belongsTo('App\Remark');
    }

    public function subscription()
    {
        return $this->belongsTo('App\Subscription');
    }
}
