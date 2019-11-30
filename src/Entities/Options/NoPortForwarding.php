<?php

namespace Almajiro\AuthorizedKeys\Entities\Options;

class NoPortForwarding extends AbstractOption
{
    public function __toString()
    {
        return 'no-port-forwarding';
    }
}
