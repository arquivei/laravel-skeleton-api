<?php

namespace App\Adapters;

use App\Events\Message;
use Arquivei\Events\Sender\Sender;
use Arquivei\Events\Sender\Schemas\BaseSchema;
use Arquivei\Events\Sender\Factories\LatestSchemaFactory;
use Core\Dependencies\EventSenderInterface;

class EventSenderAdapter implements EventSenderInterface
{
    private string $stream;
    private Sender $eventSender;
    private LatestSchemaFactory $latestSchemaFactory;

    public function __construct(Sender $sender)
    {
        $this->eventSender = $sender;
        $this->stream = env('EVENTS_STREAM', '');
        $this->latestSchemaFactory = new LatestSchemaFactory();
    }

    public function push(Message $message, string $stream = null): void
    {
        if (is_null($stream)) {
            $stream = $this->stream;
        }
        $eventMessage = $this->buildMessage($message);
        $this->eventSender->push($eventMessage, $stream);
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
