<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'customer_status_id', 'subscription_id'];

    public function customerStatus()
    {
        return $this->belongsTo('App\CustomerStatus');
    }

    public function customerStatuses()
    {
        return \App\CustomerStatus::all();
    }

    public function subscription()
    {
        return $this->belongsTo('App\Subscription');
    }

    public function subscriptions()
    {
        return \App\Subscription::all();
    }
}
