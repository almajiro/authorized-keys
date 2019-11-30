<?php

namespace Tests\Entities\Options;

use Almajiro\AuthorizedKeys\Entities\Options\NoAgentForwarding;

class NoAgentForwardingTest extends OptionTest
{
    /**
     * @test
     */
    public function toOption()
    {
        $expectedResult = 'no-agent-forwarding';
        $option = new NoAgentForwarding();

        $this->assertEquals($expectedResult, $option->__toString());
    }
}
