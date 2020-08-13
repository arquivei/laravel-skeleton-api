<?php

namespace App\Adapters\Monolog;

use Monolog\Processor\ProcessorInterface;

class DatetimeProcessor implements ProcessorInterface
{
    private string $format;

    public function __construct(string $format = 'Y-m-d H:i:s.u')
    {
        $this->format = $format;
    }

    public function __invoke(array $records)
    {
        $records['datetime'] = $records['datetime']->format($this->format);
        return $records;
    }
}
