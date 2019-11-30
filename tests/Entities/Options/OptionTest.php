<?php

namespace Tests\Entities\Options;

use Almajiro\AuthorizedKeys\Entities\PublicKey;
use PHPUnit\Framework\TestCase;

abstract class OptionTest extends TestCase
{
    public function create(array $options = [])
    {
        return new PublicKey(
            'test-ssh',
            'ssh-rsa',
            $options,
            null
        );
    }
}
