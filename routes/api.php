<?php

use App\Http\Resources\StudentResource;
use App\Http\Resources\StudentResourceCollection;
use App\Student;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/users', function () {
    return new StudentResourceCollection(Student::all());
})->name('users.list');

Route::get('/user/{n}', function ($n) {
        return new StudentResource(Student::find($n));
})->where('n', '[0-9]+');

Route::get('/user/create', function () {
    return redirect()->route('users.list');
});
Route::post('/user/create', 'StudentController@createFromApi');
