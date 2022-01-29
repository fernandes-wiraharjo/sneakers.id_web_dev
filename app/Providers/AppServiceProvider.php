<?php

namespace App\Providers;

use App\Core\Adapters\Theme;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Modules\Product\Repositories\ProductRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ProductRepository::class
        );
        // if ($this->app->isLocal()) {
        //     $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        // }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $theme = theme();

        // Share theme adapter class
        View::share('theme', $theme);

        // Set demo globally
        $theme->setDemo(request()->input('demo', 'demo1'));
        // $theme->setDemo('demo2');

        $theme->initConfig();

        bootstrap()->run();

        if (isRTL()) {
            // RTL html attributes
            Theme::addHtmlAttribute('html', 'dir', 'rtl');
            Theme::addHtmlAttribute('html', 'direction', 'rtl');
            Theme::addHtmlAttribute('html', 'style', 'direction:rtl;');
        }
    }
}
