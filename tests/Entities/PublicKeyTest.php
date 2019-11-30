<?php

use PHPUnit\Framework\TestCase;
use Almajiro\AuthorizedKeys\Entities\PublicKey;
use Almajiro\AuthorizedKeys\Entities\Options\Command;
use Almajiro\AuthorizedKeys\Entities\Options\NoPty;
use Almajiro\AuthorizedKeys\Entities\Options\NoAgentForwarding;
use Almajiro\AuthorizedKeys\Entities\Options\NoPortForwarding;

class PublicKeyTest extends TestCase
{
    /**
     * @test
     */
    public function create()
    {
        $expectedKey = 'test-key';
        $expectedType = 'ssh-rsa';
        $expectedComment = 'test@localhost';

        $publicKey = new PublicKey(
            $expectedKey,
            $expectedType,
            [],
            $expectedComment
        );

        $this->assertEquals($expectedKey, $publicKey->getKey());
        $this->assertEquals($expectedType, $publicKey->getType());
        $this->assertEquals([], $publicKey->getOptions());
        $this->assertEquals($expectedComment, $publicKey->getComment());

        return $publicKey;
    }

    /**
     * @test
     */
    public function setCommandOption()
    {
        $publicKey = $this->create();
        $command = new Command('ls');

        $publicKey->setOptions([
            $command
        ]);

        $this->assertEquals($command, $publicKey->getOptions()[0]);
    }

    /**
     * @test
     */
    public function setNoAgentForwardingOption()
    {
        $publicKey = $this->create();
        $option = new NoAgentForwarding();

        $publicKey->setOptions([
            $option
        ]);

        $this->assertEquals($option, $publicKey->getOptions()[0]);
    }

    /**
     * @test
     */
    public function setNoPortForwardingOption()
    {
        $publicKey = $this->create();
        $option = new NoPortForwarding();

        $publicKey->setOptions([
            $option
        ]);

        $this->assertEquals($option, $publicKey->getOptions()[0]);
    }

    /**
     * @test
     */
    public function setNoPtyOption()
    {
        $publicKey = $this->create();
        $option = new NoPty();

        $publicKey->setOptions([
            $option
        ]);

        $this->assertEquals($option, $publicKey->getOptions()[0]);
    }
}