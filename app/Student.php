<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Carbon\Carbon;

class Student extends Model
{
    use Searchable;

    protected $fillable = [
        'firstname',
        'surname',
        'description',
        'internship_preference',
        'internship_duration',
        'resumeurl_interactive',
        'resumeurl_static',
        'portraiturl',
        'screenshot'
    ];

    public function toSearchableArray()
    {
        $record = $this->toArray();

        $record['internship_duration'] = $this->duration();

        $record['softwares'] = $this->softwares->map(function ($data) {
            return $data['software'];
        })->toArray();
        $record['qualities'] = $this->qualities->map(function ($data) {
            return $data['quality'];
        })->toArray();;

        $record['portraiturl'] = env('APP_URL', 'http://localhost') . $record['portraiturl'];

        return $record;
    }

    public function duration()
    {
        Carbon::setlocale(app()->getLocale());
        $duration = Carbon::now()->addDays($this->internship_duration)->diffForHumans(null, true, false, 4);
        return $duration;
    }

    public function searchableAs()
    {
        return config('scout.prefix') . 'civi';
    }

    public function softwares()
    {
        return $this->belongsToMany('App\Software', 'link_softwares');
    }

    public function qualities()
    {
        return $this->belongsToMany('App\Quality', 'link_qualities');
    }

}
