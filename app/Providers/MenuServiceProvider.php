<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Menu\Laravel\Menu;
use Spatie\Menu\Laravel\Link;

class MenuServiceProvider extends ServiceProvider
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
    public function boot()
    {
        // Define your menu here
        Menu::macro('main', function () {
            return Menu::new()
                ->addClass('navbar-nav me-auto')
                ->route('dashboard', 'Dashboard')
                ->route('home', 'Note Generate')
                ->route('query', 'Query')
                ->route('role', 'Role')
                ->route('user.index', 'User')
                ->each(function (Link $item) {
                    $item->addClass('nav-link')->addClass(request()->is($item->url()) ? 'active' : '');
                })
                ->render();
        });
    }
}
