<?php

declare(strict_types=1);

namespace App\Dependencies\Event\Config;

use Arquivei\Events\Sender\Sender;

class EventSenderConfig
{
    public function __construct(
        private Sender $sender,
        private string $eventsStream,
    ) {
    }

    public function getSender(): Sender
    {
        return $this->sender;
    }

    public function getEventsStream(): string
    {
        return $this->eventsStream;
    }
}
