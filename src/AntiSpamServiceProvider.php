
<?php
namespace AntiSpam;

use Illuminate\Support\ServiceProvider;

class AntiSpamServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/Config/antispam.php', 'antispam');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/Config/antispam.php' => config_path('antispam.php'),
        ], 'config');

        $this->loadViewsFrom(__DIR__ . '/Views', 'antispam');
    }
}
