<?php

namespace App\Providers;

use App\Settings\SettingSingleton;
use Livewire\Livewire;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }


    public function boot()
    {
        Paginator::useBootstrap();

        // The site layout only loads Livewire's CSS/JS on pages that need it. A page's content is
        // rendered before the layout, so any Livewire component on the page sets this flag in time.
        Livewire::listen('mounted', function () {
            app()->instance('livewire.used_on_page', true);
        });

//        Model::preventLazyLoading(! app()->isProduction());

      

    }
}