<?php

namespace Almajiro\AuthorizedKeys\Entities\Options;

class Tunnel extends AbstractOption
{
    private $number;

    public function __construct(int $number)
    {
        $this->number = $number;
    }

    public function __toString()
    {
        return 'tunnel="'. $this->number . '"';
    }
}
