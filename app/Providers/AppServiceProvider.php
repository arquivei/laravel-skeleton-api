<?php

namespace App\Providers;

use App\Adapters\EventSenderAdapter;
use App\Adapters\Monolog\MonologLogAdapter;
use App\Adapters\Monolog\SettableTraceIdLogger;
use App\Factories\KafkaFactory;
use Arquivei\Events\Sender\Sender;
use Core\Dependencies\EventSenderInterface;
use Core\Dependencies\LogInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(LogInterface::class, MonologLogAdapter::class);
        $this->app->bind(SettableTraceIdLogger::class, LogInterface::class);

        $this->app->bind(
            EventSenderInterface::class,
            fn () => new EventSenderAdapter(new Sender(KafkaFactory::create()))
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
