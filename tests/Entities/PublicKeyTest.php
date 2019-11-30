<?php

namespace Tests;

use Almajiro\AuthorizedKeys\Entities\Options\Command;
use Almajiro\AuthorizedKeys\Entities\Options\NoAgentForwarding;
use Almajiro\AuthorizedKeys\Entities\Options\NoPortForwarding;
use Almajiro\AuthorizedKeys\Entities\Options\NoPty;
use Almajiro\AuthorizedKeys\Entities\Options\NoX11Forwarding;
use Almajiro\AuthorizedKeys\Entities\Options\Tunnel;
use Almajiro\AuthorizedKeys\Entities\PublicKey;
use PHPUnit\Framework\TestCase;

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
            $command,
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
            $option,
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
            $option,
        ]);

        $this->assertEquals($option, $publicKey->getOptions()[0]);
    }

    /**
     * @test
     */
    public function SetNoX11ForwardingOption()
    {
        $publicKey = $this->create();
        $option = new NoX11Forwarding();

        $publicKey->setOptions([
            $option,
        ]);

        $this->assertEquals($option, $publicKey->getOptions()[0]);
    }

    /**
     * @test
     */
    public function setTunnelOption()
    {
        $publicKey = $this->create();
        $option = new Tunnel(1);

        $publicKey->setOptions([
            $option,
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
            $option,
        ]);

        $this->assertEquals($option, $publicKey->getOptions()[0]);
    }

    /**
     * @test
     */
    public function setKey()
    {
        $expectedKey = 'new-key';
        $publicKey = $this->create();
        $publicKey->setKey($expectedKey);

        $this->assertEquals($expectedKey, $publicKey->getKey());
    }

    /**
     * @test
     */
    public function setType()
    {
        $expectedType = 'ssh-dss';
        $publicKey = $this->create();
        $publicKey->setType($expectedType);

        $this->assertEquals($expectedType, $publicKey->getType());
    }

    /**
     * @test
     */
    public function setComment()
    {
        $expectedComment = 'new_comment';
        $publicKey = $this->create();
        $publicKey->setComment($expectedComment);

        $this->assertEquals($expectedComment, $publicKey->getComment());
    }
}
