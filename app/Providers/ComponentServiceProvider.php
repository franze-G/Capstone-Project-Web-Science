<?php

namespace App\Providers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ComponentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        $this->registerComponentsFrom('resources/views/client');
        $this->registerComponentsFrom('resources/views/admin');
    }

    protected function registerComponentsFrom($path)
    {
        $files = glob($path . '/*.blade.php');
        foreach ($files as $file) {
            $fileName = pathinfo($file, PATHINFO_FILENAME);
            $componentName = Str::kebab($fileName);
            $viewPath = str_replace('resources/views/', '', $file);
            $viewPath = str_replace('.blade.php', '', $viewPath);
            Blade::component($viewPath, $componentName);
        }
    }
}
