<?php

namespace Almajiro\AuthorizedKeys\Entities\Options;

class NoX11Forwarding extends AbstractOption
{
    public function __toString()
    {
        return 'no-X11-forwarding';
    }
}
