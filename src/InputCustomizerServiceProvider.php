<?php

namespace BrenoFortunato\InputCustomizer;

use Illuminate\Support\ServiceProvider;

class InputCustomizerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/input-customizer'),
        ]);

        $this->publishes([
            __DIR__.'/public' => public_path('vendor/input-customizer'),
        ]);
    }
}
