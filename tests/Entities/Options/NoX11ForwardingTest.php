<?php

namespace Tests\Entities\Options;

use Almajiro\AuthorizedKeys\Entities\Options\NoX11Forwarding;

class NoX11ForwardingTest extends OptionTest
{
    /**
     * @test
     */
    public function toOption()
    {
        $expectedResult = 'no-x11-forwarding';
        $option = new NoX11Forwarding();

        $this->assertEquals($expectedResult, $option->__toString());
    }
}
