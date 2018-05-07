<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    protected $fillable = [
        'name'
    ];

    public function offers(){
        $this->hasMany('App\Offer');
    }
}
