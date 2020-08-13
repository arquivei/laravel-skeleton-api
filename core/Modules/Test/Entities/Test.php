<?php

namespace Core\Modules\Test\Entities;

class Test
{
    private int $intAttribute;
    private string $strAttribute;

    public function __construct(int $intAttribute, string $strAttribute)
    {
        $this->intAttribute = $intAttribute;
        $this->strAttribute = $strAttribute;
    }

    public function getIntAttribute(): int
    {
        return $this->intAttribute;
    }

    public function getStrAttribute(): string
    {
        return $this->strAttribute;
    }
}
