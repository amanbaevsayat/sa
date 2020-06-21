<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'subscriptionId', 'customer_status_id'];

    public function customerStatus()
    {
        return $this->belongsTo('App\CustomerStatus');
    }

    public function customerStatuses()
    {
        return \App\CustomerStatus::all();
    }
}
