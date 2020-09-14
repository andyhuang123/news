<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

 
use App\Repositories\Eloquent\BlogNavRepository;
 
use app\Repositories\BlogNavRepositoryInterface;
 
 

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
         $this->app->bind(
            BlogNavRepositoryInterface::class, 
            BlogNavRepository::class
        ); 
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
