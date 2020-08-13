<?php

namespace App\Events\Modules\Test;

use App\Events\Message;
use Core\Modules\Test\Entities\Test;

class TestEvent extends Message
{
    private const SOURCE = 'user-identity-service';
    private const VERSION = 1;
    private const TYPE = 'test-event-name';

    public function __construct(Test $entity)
    {
        parent::__construct(
            self::SOURCE,
            self::TYPE,
            self::VERSION,
            $this->data($entity)
        );
    }

    private function data(Test $entity): array
    {
        return [
            'IntAttribute' => $entity->getIntAttribute(),
            'StringAttribute' => $entity->getStrAttribute(),
        ];
    }
}
