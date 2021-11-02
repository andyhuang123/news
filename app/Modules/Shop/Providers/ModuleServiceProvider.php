<?php

namespace App\Modules\Shop\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(module_path('shop', 'Resources/Lang', 'app'), 'shop');
        $this->loadViewsFrom(module_path('shop', 'Resources/Views', 'app'), 'shop');
        $this->loadMigrationsFrom(module_path('shop', 'Database/Migrations', 'app'), 'shop');
        $this->loadConfigsFrom(module_path('shop', 'Config', 'app'));
        $this->loadFactoriesFrom(module_path('shop', 'Database/Factories', 'app'));
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
