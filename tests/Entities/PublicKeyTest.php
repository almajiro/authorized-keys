<?php

use PHPUnit\Framework\TestCase;
use Almajiro\AuthorizedKeys\Entities\PublicKey;

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
    }
}