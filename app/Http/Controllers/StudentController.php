<?php

namespace App\Http\Controllers;

use App\Software;
use App\Quality;
use Illuminate\Http\Request;
use App\Student;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class StudentController extends Controller
{
    /**
     * @param Request $request
     * @return null
     */
    public function createFromApi(Request $request)
    {

        $result = $request->json()->all();

        $return = null;

        foreach($result as $obj) {

            var_dump($obj);

            $photodata = base64_decode($obj['portrait']);
            $photo = Image::make($photodata)->widen(400)->encode('jpg');
            $photoFilename = str_slug($obj['firstname'] . $obj['surname']);
            $pathStoragePhoto = 'public/img/portrait/' . $photoFilename . '.jpg';
            $pathPublicPhoto = 'storage/img/portrait/' . $photoFilename . '.jpg';
            Storage::put($pathStoragePhoto, $photo->__toString());

            $screenshotdata = base64_decode($obj['screenshot']);
            $screenshot = Image::make($photodata)->widen(400)->encode('jpg');
            $screenshotFilename = str_slug($obj['firstname'] . $obj['surname']);
            $pathStorageScreenshot = 'public/img/screenshots/' . $screenshotFilename . '.jpg';
            $pathPublicScreenshot = 'storage/img/screenshots/' . $screenshotFilename . '.jpg';
            Storage::put($pathStorageScreenshot, $screenshot->__toString());

            $student = Student::create([
                'firstname' => $obj['firstname'],
                'surname' => $obj['surname'],
                'description' => $obj['description'],
                'internship_preference' => $obj['internship_preference'],
                'internship_duration' => $obj['internship_duration'],
                'resumeurl_interactive' => $obj['resumeurl_interactive'],
                'resumeurl_static' => $obj['resumeurl_static'],
                'portraiturl' => $pathPublicPhoto,
                "screenshoturl" => $pathPublicScreenshot,
            ]);

            if (isset($obj['softwares'])) {
                $arr=explode(",",$obj['softwares']);
                foreach ($arr as $software) {
                    // Check software and create it if needed
                    $currentSoftware = Software::where('software', $software)->first();
                    if (empty($currentSoftware)) {
                        $currentSoftware = Software::create([
                            'software' => $software
                        ]);
                    }
                    $student->softwares()->attach($currentSoftware->id);
                }
            }

            if (isset($obj['qualities'])) {
                $arr=explode(",",$obj['qualities']);
                foreach ($arr as $quality) {
                    // Check quality and create it if needed
                    $currentQuality = Quality::where('quality', trim($quality, " "))->first();
                    if (empty($currentQuality)) {
                        $qualityNameInput = mb_strtoupper(mb_substr(trim($quality, " "), 0, 1));
                        $qualityName = $qualityNameInput.mb_substr(trim($quality, " "), 1);
                        $currentQuality = Quality::create([
                            'quality' => $qualityName
                        ]);
                    }
                    $student->qualities()->attach($currentQuality->id);
                }
            }

            $student->update();

        }


    }
}
