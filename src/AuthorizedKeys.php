<?php

namespace Almajiro\AuthorizedKeys;

use Almajiro\AuthorizedKeys\Entities\Options\Command;
use Almajiro\AuthorizedKeys\Entities\Options\NoAgentForwarding;
use Almajiro\AuthorizedKeys\Entities\Options\NoPortForwarding;
use Almajiro\AuthorizedKeys\Entities\Options\NoPty;
use Almajiro\AuthorizedKeys\Entities\Options\NoX11Forwarding;
use Almajiro\AuthorizedKeys\Entities\Options\Tunnel;
use Almajiro\AuthorizedKeys\Entities\PublicKey;

class AuthorizedKeys
{
    private $keys;

    const ALLOWED_TYPES = [
        'ssh-dss',
        'ssh-ed25519',
        'ssh-rsa',
        'ecdsa-sha2-nistp256',
        'ecdsa-sha2-nistp384',
        'ecdsa-sha2-nistp521',
    ];

    public function __construct(array $keys = [])
    {
        $this->keys = $keys;
    }

    public function add(PublicKey $key)
    {
        $this->keys[] = $key;

        return $this;
    }

    public function save(string $authorizedKeys, bool $setPermission = true)
    {
        $rawData = $this->generate();

        $resource = fopen($authorizedKeys, 'w');
        fwrite($resource, $rawData);
        fclose($resource);

        if ($setPermission) {
            chmod($authorizedKeys, 0600);
        }

        return true;
    }

    public function generate()
    {
        $rawData = '';

        foreach ($this->keys as $key) {
            $rawData .= $this->toEntry($key)."\n";
        }

        return $rawData;
    }

    public function __toString()
    {
        return $this->generate();
    }

    private function toEntry(PublicKey $publicKey)
    {
        $entry = '';

        $rawOption = '';
        $counter = 0;
        $options = $publicKey->getOptions();
        foreach ($options as $option) {
            $rawOption .= $option->__toString();

            if ($counter != (count($options) - 1)) {
                $rawOption .= ',';
            }

            $counter += 1;
        }

        if ($rawOption) {
            $entry = $rawOption.' ';
        }

        $entry .= $publicKey->getType().' '.$publicKey->getKey();

        if ($publicKey->getComment()) {
            $entry .= ' '.$publicKey->getComment();
        }

        return $entry;
    }

    public static function open(string $authorizedKeys)
    {
        $resource = fopen($authorizedKeys, 'r');
        $rawData = fread($resource, filesize($authorizedKeys));
        fclose($resource);

        return new static(self::parse($rawData));
    }

    private static function parse($rawData)
    {
        $keys = [];
        $lines = explode("\n", $rawData);
        foreach ($lines as $line) {
            if (preg_match('/^(?:(.+) )?('.implode('|', self::ALLOWED_TYPES).') ([^ ]+) ?(.*)$/', $line, $matches)) {
                $options = $matches[1];
                $type = $matches[2];
                $key = $matches[3];
                $comment = $matches[4];

                $keys[] = new PublicKey($key, $type, self::parseOption($options), $comment);
            }
        }

        return $keys;
    }

    private static function parseOption($rawOptions)
    {
        $options = [];

        $rawOptions = explode(',', $rawOptions);
        foreach ($rawOptions as $rawOption) {
            if (preg_match('/^command="(.*)"/', $rawOption, $matches)) {
                $options[] = new Command($matches[1]);
            }

            if (preg_match('/^tunnel="(.*)"/', $rawOption, $matches)) {
                $options[] = new Tunnel($matches[1]);
            }

            if ($rawOption === 'no-agent-forwarding') {
                $options[] = new NoAgentForwarding();
            }

            if ($rawOption === 'no-port-forwarding') {
                $options[] = new NoPortForwarding();
            }

            if ($rawOption === 'no-pty') {
                $options[] = new NoPty();
            }

            if ($rawOption === 'no-X11-forwarding') {
                $options[] = new NoX11Forwarding();
            }
        }

        return $options;
    }
}
