<?php

namespace Core\Dependencies;

use App\Events\Message;

interface EventSenderInterface
{
    public function push(Message $message): void;
}
