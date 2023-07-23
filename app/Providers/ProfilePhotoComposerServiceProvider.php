<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ProfilePhotoComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.admin.master', function ($view) {
            $user = auth()->user();
            $profileImage = ''; // Initialize the profile image variable

            if ($user && $user->profile) {
                $profileImage = $user->profile->image;
            }

            $view->with('profileImage', $profileImage);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
