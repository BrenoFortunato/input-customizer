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
        $this->loadViewsFrom(__DIR__.'/resources/views/', 'input-customizer');
    }
}