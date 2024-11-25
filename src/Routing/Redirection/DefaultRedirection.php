<?php

namespace Src\Routing\Redirection;

class DefaultRedirection implements RedirectionInterface
{
    protected array $redirections = [
        '/' => '/home'
    ];

    public function getRedirections(): array
    {
        return $this->redirections;
    }
}