<?php

namespace Modules\Pengaturan\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Core\User;
use Modules\Pengaturan\Observers\UserObserver;

class UserServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Daftarkan observer User
        User::observe(UserObserver::class);
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
