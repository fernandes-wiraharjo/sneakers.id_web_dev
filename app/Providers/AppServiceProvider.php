<?php

namespace App\Providers;

use App\Core\Adapters\Theme;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Modules\Product\Repositories\ProductRepository;
use Modules\Brand\Repositories\BrandRepository;
use Modules\SignaturePlayer\Repositories\SignaturePlayerRepository;
use Modules\GlobalSetting\Entities\GlobalSetting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
    public function boot(BrandRepository $brandRepository, SignaturePlayerRepository $signaturePlayerRepository)
    {

        \Midtrans\Config::$serverKey    = config('services.midtrans.serverKey');
        \Midtrans\Config::$clientKey    = config('services.midtrans.clientKey');
        \Midtrans\Config::$isProduction = Str::lower(config('services.midtrans.environment')) === 'production' ? true : false;
        $theme = theme();

        // Share theme adapter class
        View::share('theme', $theme);

        $global_settings = GlobalSetting::all();
        $gs_favicon = $global_settings->where('setting_code', 'favicon')->first();
        $gs_logo_navbar = $global_settings->where('setting_code', 'logo_navbar')->first();
        $gs_logo_footer = $global_settings->where('setting_code', 'logo_footer')->first();
        $gs_auth_page_side_image_website = $global_settings->where('setting_code', 'auth_page_side_image_website')->first();
        $gs_auth_page_side_image_mobile = $global_settings->where('setting_code', 'auth_page_side_image_mobile')->first();
        View::share('favicon', $gs_favicon ? $gs_favicon->setting_value : asset('stores-info/logos.png'));
        View::share('logo_navbar', $gs_logo_navbar ? $gs_logo_navbar->setting_value : asset('stores-info/logo-black-new.png'));
        View::share('logo_footer', $gs_logo_footer ? $gs_logo_footer->setting_value : asset('stores-info/logo-white-new.png'));
        View::share('auth_page_side_image_website', $gs_auth_page_side_image_website ? $gs_auth_page_side_image_website->setting_value : asset('stores-info/login-img-md.webp'));
        View::share('auth_page_side_image_mobile', $gs_auth_page_side_image_mobile ? $gs_auth_page_side_image_mobile->setting_value : asset('stores-info/login-img.webp'));

        // Share common data across all views
        View::share('brand', $brandRepository->getAllBrand());
        View::share('brand_menu', $brandRepository->getActiveMenuBrand());
        View::share('signature', $signaturePlayerRepository->getAllSignatures());

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
            $brand_is_menu =  $brandRepository->checkActiveMenuBrand();

            if(intval($value)){
                $brand_is_menu++;
            }

            return $brand_is_menu <= 3;
        });
    }
}
