<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Directive for long date format
        Blade::directive('longdate', function ($date) {
            return "<?php echo \Carbon\Carbon::parse($date)->format('jS F Y'); ?>";
        });
        
        //Directive for currency format
        Blade::directive('currencyformat', function ($amount) {
            return "<?php echo number_format($amount, 2); ?>";
        });
    }



    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
