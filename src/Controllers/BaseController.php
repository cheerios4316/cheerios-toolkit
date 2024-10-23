<?php
namespace Src\Controllers;
use Src\Classes\RedirectManager;
use Src\Components\Page404Component\Page404Component;
use Src\Components\PageComponent\PageComponent;
use Src\Container\Container;

class BaseController
{
    /**
     * When true page is restricted to logged users
     * @var bool
     */
    protected bool $isLoginProtected = false;
    protected RedirectManager $redirectManager;

    protected static string $url = '';

    protected Container $container;

    public function __construct(RedirectManager $redirectManager)
    {
        $this->redirectManager = $redirectManager;
        $this->container = Container::getInstance();
        
        $this->loginProtect();
    }

    protected function loginProtect()
    {
        if($this->isLoginProtected) {
            if($_SESSION['logged'] !== true) {
                $this->redirectManager->redirect('/login');
            }
        }
    }

    public function renderPage()
    {
        $page = $this->generatePage();
        if(!$page) {
            $this->render404();
        } else {
            $page->render();
        }
    }

    protected function render404()
    {
        //(new Page404Component())->render();
    }

    public static function getUrl(): string
    {
        return self::$url;
    }
}