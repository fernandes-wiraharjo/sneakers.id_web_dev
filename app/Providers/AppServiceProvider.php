<?php

namespace App\Providers;

use App\Core\Adapters\Theme;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Modules\Product\Repositories\ProductRepository;
use Modules\Brand\Repositories\BrandRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;

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
    public function boot(BrandRepository $brandRepository)
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

        Builder::macro('whereLike', function ($attributes, string $searchTerm) {
            $this->where(function (Builder $query) use ($attributes, $searchTerm) {
                foreach ($attributes as $attribute) {
                    $query->when(
                        str_contains($attribute, '.'),
                        function (Builder $query) use ($attribute, $searchTerm) {
                            [$relationName, $relationAttribute] = explode('.', $attribute);

                            $query->orWhereHas($relationName, function (Builder $query) use ($relationAttribute, $searchTerm) {
                                $query->where($relationAttribute, 'LIKE', "%{$searchTerm}%");
                            });
                        },
                        function (Builder $query) use ($attribute, $searchTerm) {
                            $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                        }
                    );
                }
            });

            return $this;
        });

        Validator::extend('brandmenu', function($attribute, $value, $parameters) use ($brandRepository) {
            $brand_is_menu =  $brandRepository->getBrandMenu()->count();
            if($value){
                $brand_is_menu++;
            }
            return $brand_is_menu <= 3;
        });
    }
}
