<?php

namespace Almajiro\AuthorizedKeys\Entities\Options;

class NoPty extends AbstractOption
{
    public function __toString()
    {
        return 'no-pty';
    }
}
