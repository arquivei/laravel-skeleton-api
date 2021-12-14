<?php

namespace Core\Dependencies\Event;

use App\Dependencies\Event\Message;

interface EventSenderInterface
{
    public function push(Message $message): void;
}
