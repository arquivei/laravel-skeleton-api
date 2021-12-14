<?php

namespace App\Providers;

use App\Dependencies\Event\Adapter\EventSenderAdapter;
use App\Dependencies\Event\Config\EventSenderConfig;
use App\Factories\KafkaFactory;
use Arquivei\Events\Sender\Sender;
use Arquivei\LogAdapter\Log;
use Arquivei\LogAdapter\LogAdapter;
use Core\Dependencies\Event\EventSenderInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Log::class, LogAdapter::class);

        $this->app->bind(EventSenderConfig::class, fn() => new EventSenderConfig(
            sender: new Sender(KafkaFactory::create()),
            eventsStream: env('EVENTS_STREAM', 'events')
        ));
        $this->app->bind(EventSenderInterface::class, EventSenderAdapter::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
