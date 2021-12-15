<?php

declare(strict_types=1);

namespace App\Dependencies\Event\Adapter;

use App\Dependencies\Event\Config\EventSenderConfig;
use App\Dependencies\Event\Message;
use Arquivei\Events\Sender\Factories\LatestSchemaFactory;
use Arquivei\Events\Sender\Schemas\BaseSchema;
use Arquivei\Events\Sender\Sender;
use Core\Dependencies\Event\EventSenderInterface;

class EventSenderAdapter implements EventSenderInterface
{
    private string $stream;

    private Sender $sender;

    public function __construct(
        EventSenderConfig $eventSenderConfig,
        private LatestSchemaFactory $latestSchemaFactory,
    ) {
        $this->sender = $eventSenderConfig->getSender();
        $this->stream = $eventSenderConfig->getEventsStream();
    }

    public function push(Message $message, string $stream = null): void
    {
        if (is_null($stream)) {
            $stream = $this->stream;
        }
        $eventMessage = $this->buildMessage($message);
        $this->sender->push($eventMessage, $stream);
    }

    private function buildMessage(Message $message): BaseSchema
    {
        return $this->latestSchemaFactory->createFromParameters(
            $message->getSource(),
            $message->getDataType(),
            $message->getDataVersion(),
            $message->getData()
        );
    }
}
