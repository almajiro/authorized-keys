<?php

namespace Almajiro\AuthorizedKeys\Entities;

use Almajiro\AuthorizedKeys\Entities\Options\AbstractOption;

class PublicKey
{
    private $key;

    private $type;

    private $options;

    private $comment;

    public function __construct(
        string $key,
        string $type,
        array $options = [],
        string $comment = null
    ) {
        $this->key = $key;
        $this->type = $type;
        $this->options = $options;
        $this->comment = $comment;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return AbstractOption[]
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param AbstractOption[] $options
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }
}
