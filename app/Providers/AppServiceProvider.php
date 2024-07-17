<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteTeam;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Contracts\DeletesTeams;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        // Bind DeletesTeams interface to DeleteTeam implementation
        $this->app->bind(DeletesTeams::class, DeleteTeam::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
