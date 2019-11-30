Authorized Keys
======

[![Build Status](https://travis-ci.org/almajiro/authorized-keys.svg?branch=master)](https://travis-ci.org/almajiro/authorized-keys)

Manage SSH `authorized_keys`

# Installation

```shell
composer require almajiro/authorized-keys
```

# Example

## Create New authorized_keys

```
use Almajiro\AuthorizedKeys\AuthorizedKeys;
use Almajiro\AuthorizedKeys\Entities\PublicKey;

$keys = new AuthorizedKeys();
$publicKey = new PublicKey('AAAAB3NzaC1yc2EAAAADAQABAAABAQDZd6ljNm...', 'ssh-rsa', [], 'admin@localhost');
$keys->add($publicKey);

$keys->save('~/.ssh/authorized_keys');
```

## Read from authorized_keys

```
use Almajiro\AuthorizedKeys\AuthorizedKeys;

$keys = AuthorizedKeys::open('~/.ssh/authorized_keys');
var_dump($keys);

object(Almajiro\AuthorizedKeys\AuthorizedKeys)#1 (1) {
  ["keys":"Almajiro\AuthorizedKeys\AuthorizedKeys":private]=>
  array(3) {
    [0]=>
    object(Almajiro\AuthorizedKeys\Entities\PublicKey)#2 (4) {
      ["key":"Almajiro\AuthorizedKeys\Entities\PublicKey":private]=>
      string(372) "AAAAB3NzaC1yc2EAAAADAQABAAABAQDZd6ljNm..."
      ["type":"Almajiro\AuthorizedKeys\Entities\PublicKey":private]=>
      string(7) "ssh-rsa"
      ["options":"Almajiro\AuthorizedKeys\Entities\PublicKey":private]=>
      array(2) {
        [0]=>
        object(Almajiro\AuthorizedKeys\Entities\Options\Command)#4 (1) {
          ["command":"Almajiro\AuthorizedKeys\Entities\Options\Command":private]=>
          string(16) "ls"
        }
        [1]=>
        object(Almajiro\AuthorizedKeys\Entities\Options\NoAgentForwarding)#5 (0) {
        }
      }
      ["comment":"Almajiro\AuthorizedKeys\Entities\PublicKey":private]=>
      string(17) "admin@localhost"
    }
    [1]=>
    object(Almajiro\AuthorizedKeys\Entities\PublicKey)#6 (4) {
      ["key":"Almajiro\AuthorizedKeys\Entities\PublicKey":private]=>
      string(372) "AAAAB3NzaC1yc2EAAAADAQABAAABAQDZd6ljNm..."
      ["type":"Almajiro\AuthorizedKeys\Entities\PublicKey":private]=>
      string(7) "ssh-rsa"
      ["options":"Almajiro\AuthorizedKeys\Entities\PublicKey":private]=>
      array(0) {
      }
      ["comment":"Almajiro\AuthorizedKeys\Entities\PublicKey":private]=>
      string(0) ""
    }

```

## Add Public-Key with some options

```
use Almajiro\AuthorizedKeys\Entities\PublicKey;
use Almajiro\AuthorizedKeys\Entities\Options\NoX11Forwarding;

$publicKey = new PublicKey(
	'AAAAB3NzaC1yc2EAAAADAQABAAABAQDZd6ljNm...',
	'ssh-rsa',
	[
		new NoX11Forwarding()
	],
	'admin@localhost'
);

$keys->add($publicKey);
```

