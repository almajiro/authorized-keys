<?php

namespace Almajiro\AuthorizedKeys\Entities\Options;

class NoAgentForwarding extends AbstractOption
{
    public function __toString()
    {
        return 'no-agent-forwarding';
    }
}
