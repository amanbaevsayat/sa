<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{
    protected $fillable = ['title'];
    
    public static function getByTitle(string $title){
        return self::where('title', $title)->first();
    }
}
