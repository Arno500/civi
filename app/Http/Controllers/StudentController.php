<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentController extends Controller
{
    public function createFromApi(Request $request)
    {

        $result = json_decode($request);

        $photodata = base64_decode($request['portrait']);
        $photo = Image::make($photodata)->widen(400)->encode('jpg');
        $photoFilename = str_slug($request['firstname'].$request['surname']);
        $pathStoragePhoto = 'public/img/portrait/' . $photoFilename . '.jpg';
        $pathPublicPhoto = 'storage/img/portrait/' . $photoFilename . '.jpg';
        Storage::put($pathStoragePhoto, $photo->__toString());

        $screenshotdata = base64_decode($request['screenshot']);
        $screenshot = Image::make($photodata)->widen(400)->encode('jpg');
        $screenshotFilename = str_slug($request['firstname'].$request['surname']);
        $pathStorageScreenshot = 'public/img/screenshots/' . $screenshotFilename . '.jpg';
        $pathPublicScreenshot = 'storage/img/screenshots/' . $screenshotFilename . '.jpg';
        Storage::put($pathStorageScreenshot, $screenshot->__toString());

        Student::create([
            'firstname' => $request['firstname'],
            'surname' => $request['surname'],
            'description' => $request['description'],
            'internship_preference' => $request['internship_preference'],
            'resumeurl_interactive' => $request['resumeurl_interactive'],
            'resumeurl_static' => $request['resumeurl_static'],
            'portraiturl' => $pathPublicPhoto,
            "screenshoturl" => $pathPublicScreenshot,
        ]);

        return response()->json();
    }
}
