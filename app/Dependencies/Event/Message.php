<?php

namespace App\Dependencies\Event;

class Message
{
    private array $data;
    private string $source;
    private string $dataType;
    private int $dataVersion;

    public function __construct(
        string $source,
        string $dataType,
        int $dataVersion,
        array $data
    ) {
        $this->data = $data;
        $this->source = $source;
        $this->dataType = $dataType;
        $this->dataVersion = $dataVersion;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function getDataType(): string
    {
        return $this->dataType;
    }

    public function getDataVersion(): int
    {
        return $this->dataVersion;
    }
}
