<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class Offer extends Model
{
    protected $fillable = [
        'enterprise_id',
        'name',
        'description',
        'internship_duration'
    ];

    public function enterprise() {
        return $this->belongsTo('App\Enterprise');
    }

    public function duration() {
        Carbon::setlocale(app()->getLocale());
        $duration = Carbon::now()->addDays($this->internship_duration)->diffForHumans(null, true, false, 4);
        return $duration;
    }
}
