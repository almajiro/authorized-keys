<?php

namespace Tests\Entities\Options;

use Almajiro\AuthorizedKeys\Entities\Options\NoPortForwarding;

class NoPortForwardingTest extends OptionTest
{
    /**
     * @test
     */
    public function toOption()
    {
        $expectedResult = 'no-port-forwarding';
        $option = new NoPortForwarding();

        $this->assertEquals($expectedResult, $option->__toString());
    }
}
