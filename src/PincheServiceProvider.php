<?php

namespace ZCJY\Pinche;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use ZCJY\Pinche\Models\banner;
use ZCJY\Pinche\Models\Link;
use Illuminate\Support\Facades\Cache;
use Illuminate\Routing\Router;

class PincheServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    public function boot()
    {

        //Schema::defaultStringLength(191);

        view()->composer('*',function($view){
            $banners = Cache::remember('banners', 1, function(){
                return banner::all();
            });
            $links = Cache::remember('links', 1, function(){
                return Link::all();
            });

            $view->with('banners',$banners)->with('links',$links);
        });


        //加载视图
        $this->loadViewsFrom(realpath(__DIR__.'/views'), 'pinche');

        //$this->setupRoutes($this->app->router);
        
        //加载中间件
        $this->app->router->middleware('weixincheck', 'ZCJY\Pinche\Http\Middleware\WeixinCheckMiddleware');

        //加载路由
        require __DIR__.'/Http/routes.php';
    
        $this->publishes([
            //migrations
            __DIR__.'/migrations/' => database_path('migrations'),
            // this for conig
            __DIR__.'/config/pinche.php' => config_path('pinche.php'),
            //seeder
            //__DIR__.'/seeds/UserTalbeSeeder.php' => database_path('seeds/UserTalbeSeeder.php'),
            //assets
            __DIR__.'/assets' => public_path('vendor/pinche'),
        ], 'pinche');
    }

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'ZCJY\Pinche\Http\Controllers'], function($router)
        {
            require __DIR__.'/Http/routes.php';
        });
    }
    
    public function register()
    {
        $this->registerContact();
        config([
            'config/pinche.php',
        ]);
    }
    private function registerContact()
    {
        $this->app->bind('pinche',function($app){
            return new Pinche($app);
        });
    }
}
