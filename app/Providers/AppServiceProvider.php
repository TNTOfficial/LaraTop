<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $excludes = array('about_us', 'about_us_short');
        if (Schema::hasTable('settings')) {
            foreach (Setting::all() as $setting) {
                if (in_array($setting->key, $excludes)) {
                    continue;
                }                
                Config::set('settings.' . $setting->key, $setting->value);
            }
        }
    }
}
