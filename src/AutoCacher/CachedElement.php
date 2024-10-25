<?php

namespace Src\AutoCacher;

use DateTime;

class CachedElement
{
    protected int $expire = 600;
    protected int $timestamp;

    protected $value;
    
    public function setValue($value)
    {
        $this->timestamp = time();

        $this->value = $value;
        return $this;
    }

    public function setExpire(int $expire): self
    {
        $this->expire = $expire;
        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function isExpired(): bool
    {
        return time() > $this->timestamp + $this->expire;
    }
}