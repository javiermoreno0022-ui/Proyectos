<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CalculadoraComision;
use App\Services\Comisiones\ComisionTarjeta;
use App\Services\Comisiones\ComisionTransferencia;
use App\Services\Comisiones\ComisionBilletera;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    $this->app->singleton(CalculadoraComision::class, fn () => new CalculadoraComision([
        new ComisionTarjeta(),
        new ComisionTransferencia(),
        new ComisionBilletera(),
    ]));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
