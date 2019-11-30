<?php

namespace Tests\Entities\Options;

use Almajiro\AuthorizedKeys\Entities\Options\Command;

class CommandTest extends OptionTest
{
    /**
     * @test
     */
    public function toOption()
    {
        $expectedCommand = 'ls -la';
        $expectedResult = 'command="'.$expectedCommand.'"';
        $option = new Command($expectedCommand);

        $this->assertEquals($expectedResult, $option->__toString());
    }
}
