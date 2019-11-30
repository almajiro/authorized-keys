<?php

namespace Tests;

use Almajiro\AuthorizedKeys\AuthorizedKeys;
use Almajiro\AuthorizedKeys\Entities\PublicKey;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;

class AuthorizedKeysTest extends TestCase
{
    private $testContent = <<< '__EOF__'
command="ls",no-agent-forwarding ssh-rsa ABCDEFG test@localhost.com
ssh-dss HIJK test2@globalhost.com
tunnel="2" ssh-rsa OKOK test@localhost
no-pty,no-X11-forwarding ssh-rsa hogehoge test@localhost
no-port-forwarding ssh-rsa hogehogehoge test@hogehoge

__EOF__;

    /**
     * @test
     */
    public function readFromFile()
    {
        $directory = vfsStream::setup();
        $file = vfsStream::newFile('authorized_keys')
            ->withContent($this->testContent)
            ->at($directory);

        $keys = AuthorizedKeys::open($file->url());
        $this->assertEquals($this->testContent, (string) $keys);
    }

    /**
     * @test
     */
    public function saveToFile()
    {
        $expectedContent = <<< '__EOF__'
ssh-rsa ABCDE

__EOF__;

        $directory = vfsStream::setup();
        $file = vfsStream::newFile('authorized_keys')
            ->at($directory);

        $keys = new AuthorizedKeys();
        $keys->add(new PublicKey(
            'ABCDE',
            'ssh-rsa',
            [],
            null
        ));

        $keys->save($file->url());

        $this->assertTrue($directory->hasChild('authorized_keys'));
        $this->assertEquals($expectedContent, $file->getContent());

        $this->assertTrue($file->isReadable($file->getUser(), $file->getGroup()), 'File should be readable by the owner');
        $this->assertTrue($file->isWritable($file->getUser(), $file->getGroup()), 'File should be writable by the owner');
        $this->assertFalse($file->isReadable('other', 'other'), 'File should not be readable by others');
        $this->assertFalse($file->isWritable('other', 'other'), 'File should not be writable by others');
    }
}
