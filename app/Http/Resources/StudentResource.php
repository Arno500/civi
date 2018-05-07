<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        if (!isset($this->id)){
            return [
                'error' => 'No entry found for this ID'
            ];
        } else {
            return [
                'id' => $this->id,
                'firstname' => $this->firstname,
                'surname' => $this->surname,
                'name' => $this->firstname." ".$this->surname,
                'internship' => [
                    'duration' => $this->internship_duration,
                    'preference' => $this->internship_preference
                ],
                'qualitites' => json_decode($this->qualities),
                'softwares' => json_decode($this->softwares),
                'url' => [
                    'portraiturl' => $this->portraiturl,
                    'resumeurl_interactive' => $this->resumeurl_interactive,
                    'resumeurl_static' => $this->resumeurl_static
                ]
            ];
        }
    }
}
