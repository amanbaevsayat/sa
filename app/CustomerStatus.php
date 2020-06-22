<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerStatus extends Model
{
    protected $fillable = ['title'];

    public function customers()
    {
        return $this->hasMany('App\Customer');
    }
}
