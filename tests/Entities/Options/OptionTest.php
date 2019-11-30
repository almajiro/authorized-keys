<?php

namespace Tests\Entities\Options;

use PHPUnit\Framework\TestCase;
use Almajiro\AuthorizedKeys\Entities\PublicKey;

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
