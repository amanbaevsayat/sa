<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'remark_id', 'subscription_type_id', 'subscription_id', 'start_date', 'end_date'];

    public function remark()
    {
        return $this->belongsTo('App\Remark');
    }

    public function subscription()
    {
        return $this->belongsTo('App\Subscription');
    }

    public function subscriptionType()
    {
        return $this->belongsTo('App\SubscriptionType');
    }

    public function daysLeft()
    {
        if (!$this->end_date) return '';
        $now = time();
        $end_date = strtotime($this->end_date);
        $datediff = $end_date - $now;

        return round($datediff / (60 * 60 * 24));
    }

    public function getStartDateAttribute($date)
    {
        return Carbon::parse($date)->format('d F Y');
    }
    public function getEndDateAttribute($date)
    {
        return Carbon::parse($date)->format('d F Y');
    }
}
