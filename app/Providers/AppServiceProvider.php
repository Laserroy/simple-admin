<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\Company;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

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

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add('MAIN NAVIGATION');
            $event->menu->add([
                'text'        => 'Companies',
                'url'         => 'admin/companies',
                'icon'        => 'fa fa-building',
                'label'       => Company::count(),
                'label_color' => 'success',
            ]);
            $event->menu->add([
                'text'        => 'Clients',
                'url'         => 'admin/clients',
                'icon'        => 'fa fa-users',
                'label'       => Client::count(),
                'label_color' => 'success',
            ]);
        });

        Paginator::useBootstrap();
    }
}
