<?php

namespace Src\Classes\IndexConfiguration;

use Src\Classes\RedirectManager;
use Src\Container\Container;
use Src\Routing\Redirection\DefaultRedirection;
use Src\Routing\Redirection\RedirectionInterface;

class RedirectionInit implements InitActionInterface
{
    protected array $redirections = [
        DefaultRedirection::class
    ];

    public function exec(): void
    {
        $container = Container::getInstance();

        $redirectManager = $container->create(class: RedirectManager::class);

        foreach($this->redirections as $redirection) {
            $redirectionObj = $container->create($redirection);;

            $redirectManager->addRedirection($redirectionObj);
        }
    }
}