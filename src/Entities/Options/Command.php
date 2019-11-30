<?php

namespace Almajiro\AuthorizedKeys\Entities\Options;

class Command extends AbstractOption
{
    private $command;

    public function __construct(string $command)
    {
        $this->command = $command;
    }

    public function __toString()
    {
        $command = preg_replace("/\"/", '\\"', $this->command);

        return 'command="'.$command.'"';
    }
}
