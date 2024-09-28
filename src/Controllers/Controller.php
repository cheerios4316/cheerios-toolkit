<?php
namespace Src\Controllers;
use Src\Classes\RedirectManager;
use Src\Components\Page404Component\Page404Component;
use Src\Components\PageComponent\PageComponent;

abstract class Controller
{
    /**
     * When true page is restricted to logged users
     * @var bool
     */
    protected bool $isLoginProtected = false;
    protected RedirectManager $redirectManager;

    /**
     * No dependency injection because there is no time.
     * Initialize dependencies directly in the constructor and
     * call parent::__construct() in child classes.
     */
    public function __construct()
    {
        $this->redirectManager = new RedirectManager();
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
        (new Page404Component())->render();
    }

    protected abstract function generatePage(): PageComponent;
}