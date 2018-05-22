<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quality extends Model
{
    protected $table = 'qualities';

    protected $fillable = [
        'quality'
    ];

    public $timestamps = false;
}
