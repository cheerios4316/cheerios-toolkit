<?php

namespace Src\Classes\PageManager;

use Src\Classes\PageManager\PageDependency\DependencyFactory;
use Src\Classes\PageManager\PageDependency\DependencyInterface;
use Src\Classes\RedirectManager;
use Src\Controllers\ControllerInterface;

class PageManager
{

    protected static string $pageLang = 'en';
    protected DependencyFactory $dependencyFactory;

    protected RedirectManager $redirectManager;

    protected ?ControllerInterface $controller = null;

    /** @var DependencyInterface[] */
    protected static array $dependencies = [];

    private array $defaultDependencies = [
        [
            "type" => "script",
            "link" => "/vendor/components/jquery/jquery.min.js"
        ],
        [
            "type" => "script",
            "link" => "/vendor/components/jqueryui/jquery-ui.min.js"
        ],
        [
            "type" => "stylesheet",
            "link" => "/vendor/components/jqueryui/themes/base/jquery-ui.min.css"
        ],
        [
            "type" => "stylesheet",
            "link" => "/public/css/tailwind.css"
        ],
        [
            "type" => "stylesheet",
            "link" => "/vendor/fortawesome/font-awesome/css/all.min.css"
        ],
        [
            "type" => "icon",
            "link" => "/public/assets/favicon.ico"
        ],
        [
            "type" => "script",
            "link" => "/src/Application.js"
        ],
    ];

    public function __construct(DependencyFactory $dependencyFactory, RedirectManager $redirectManager)
    {
        $this->redirectManager = $redirectManager;
        $this->dependencyFactory = $dependencyFactory;
    }

    public function getContentDependencies(): string
    {
        $result = '';

        foreach($this->getDependenciesWithDefault() as $dep) {
            $result .= $dep->render();
        }

        return $result;
    }

    public function renderDependencies(): self
    {
        echo $this->getContentDependencies();
        return $this;
    }

    public function renderHead(): self
    {
        echo "<head>";
        $this->renderDependencies();
        echo $this->controller->getMetaHtmlTags();
        echo "</head>";
        return $this;
    }

    public function renderPage(): void
    {
        $this->controller = $this->redirectManager->getController($_SERVER['REQUEST_URI']);

        // Controller's renderPage() method returns the HTML content of the page
        $html = $this->controller->renderPage();

        echo "<!DOCTYPE html>";
        echo "<html lang=\"" . self::$pageLang . "\">";
        $this->renderHead();

        echo "<body>";
        echo $html;
        echo "</body>";
        echo "</html>";
    }

    private function getDependenciesWithDefault(): array
    {
        $defaults = [];
        foreach($this->defaultDependencies as $dep) {
            $defaults[] = $this->dependencyFactory->createByType($dep['type'], $dep['link']);
        }

        return array_merge($defaults, self::$dependencies);
    }

    public static function addDependency(DependencyInterface $dependency): void
    {
        self::$dependencies[] = $dependency;
    }
}