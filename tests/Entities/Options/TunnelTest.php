<?php

namespace Tests\Entities\Options;

use Almajiro\AuthorizedKeys\Entities\Options\Tunnel;

class TunnelTest extends OptionTest
{
    /**
     * @test
     */
    public function toOption()
    {
        $expectedResult = 'tunnel="2"';
        $option = new Tunnel(2);

        $this->assertEquals($expectedResult, $option->__toString());
    }
}
