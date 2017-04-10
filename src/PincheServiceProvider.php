<?php

namespace ZCJY\Pinche;

use Illuminate\Support\ServiceProvider;
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
        //加载视图
        $this->loadViewsFrom(realpath(__DIR__.'/views'), 'pinche');
        //$this->setupRoutes($this->app->router);
        //加载路由
        require __DIR__.'/Http/routes.php';
        //加载中间件
        $this->app->router->middleware('weixincheck', 'ZCJY\Pinche\Middleware\WeixinCheckMiddleware');
        //加载迁移文件
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        // this for conig
        $this->publishes([
            __DIR__.'/config/pinche.php' => config_path('pinche.php'),
        ], 'config');
        //seeder
        $this->publishes([
            __DIR__.'/seeds/UserTalbeSeeder.php' => database_path('seeds/UserTalbeSeeder.php'),
        ], 'seeder');
        //assets
        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/pinche'),
        ], 'public');
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
