<?php

namespace Tests\Entities\Options;

use Almajiro\AuthorizedKeys\Entities\Options\NoPty;

class NoPtyTest extends OptionTest
{
    /**
     * @test
     */
    public function toOption()
    {
        $expectedResult = 'no-pty';
        $option = new NoPty();

        $this->assertEquals($expectedResult, $option->__toString());
    }
}
