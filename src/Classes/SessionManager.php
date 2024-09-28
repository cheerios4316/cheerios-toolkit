<?php

namespace Src\Classes;

class SessionManager
{
    public function __construct()
    {
        if(session_Status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * @param $key
     * @param $val
     * @return $this
     */
    public function set($key, $val): self
    {
        $_SESSION[$key] = $val;
        return $this;
    }

    /**
     * @param array $keys
     * @param array $vals
     * @return $this
     */
    public function multi_set(array $keys, array $vals): self
    {
        foreach($keys as $id=>$key) {
            $_SESSION[$key] = $vals[$id];
        }
        return $this;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function get($key = null): mixed
    {
        if(!$key) {
            return $_SESSION;
        }

        return $_SESSION[$key] ?? null;
    }
}