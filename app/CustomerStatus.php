<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerStatus extends Model
{
    public function customers()
    {
        return $this->hasMany('App\Customer');
    }
}