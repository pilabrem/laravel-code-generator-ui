<?php

namespace Pilabrem\CodeGeneratorUI;

use Illuminate\Support\ServiceProvider;
//use Pilabrem\DBLog\Http\Classes\DBLog;

class CodeGeneratorUiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/ressources/Views', 'code-generator-ui');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
            __DIR__.'/public' => public_path('vendor/code-generator-ui'),
        ], 'public');

        $this->publishes([
            __DIR__.'/ressources/Views' => resource_path('views/vendor/code-generator-ui'),
        ], 'views');

        /* $this->publishes([
            __DIR__.'/config/dblog.php' => config_path('dblog.php'),
        ]); */
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Binding de la classe DBLog pour être utilisé dans sa facade
        /* $this->app->bind('classe.dblog', function () {
            return new DBLog();
        }); */
    }
}
