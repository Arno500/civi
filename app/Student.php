<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Student extends Model
{
    use Searchable;

    public function toSearchableArray()
    {
        $record = $this->toArray();


        $record['_internship_duration'] = $record['internship_duration'];

        $record['name'] = $record['firstname']." ".$record['surname'];

        $record['softwares'] = $this->softwares->map(function ($data) {
            return $data['software'];
        })->toArray();
        $record['qualities'] = $this->qualities->map(function ($data) {
            return $data['quality'];
        })->toArray();;

        unset($record['internship_duration'], $record['firstname'], $record['surname']);

        return $record;
    }

    public function searchableAs()
    {
        return config('scout.prefix').'civi';
    }

    public function softwares(){
        return $this->belongsToMany('App\Software', 'link_softwares');
    }

    public function qualities(){
        return $this->belongsToMany('App\Quality', 'link_qualities');
    }

}
