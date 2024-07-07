<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
            Blade::directive('datetime', function (string $expression) {
                return "<?= ($expression)->format('d/m/Y H:i:s'); ?>";
            });
        // Un service provider permet d'enregistrer de nouveau service pour notre application et de la configurer
    }
}
