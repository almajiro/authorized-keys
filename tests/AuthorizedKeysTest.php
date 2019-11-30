<?php

namespace Tests;

use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;
use Almajiro\AuthorizedKeys\AuthorizedKeys;

class AuthorizedKeysTest extends TestCase
{
    /**
     * @test
     */
    public function readFromFile()
    {
        $content = <<< __EOF__
command="ls",no-agent-forwarding ssh-rsa ABCDEFG test@localhost.com
ssh-dss HIJK test2@globalhost.com
tunnel="2" ssh-rsa OKOK test@localhost
no-pty,no-X11-forwarding ssh-rsa test@localhost

__EOF__;

        $directory = vfsStream::setup();
        $file = vfsStream::newFile('authorized_keys')
            ->withContent($content)
            ->at($directory);

        $keys = AuthorizedKeys::open($file->url());
        $this->assertEquals($content, (string)$keys);
    }
}
