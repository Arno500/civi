<?php

namespace App\Providers;

use App\Http\Resources\StudentResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        StudentResource::withoutWrapping();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Uploads\UploadProfilePictureInterface',
            'App\Uploads\UploadProfilePicture'
        );
    }
}
