<?php

namespace Src\Components\HeaderComponent;

use Src\Components\Component;
use Src\Components\IconComponent\IconComponent;

class HeaderComponent extends Component
{
    protected $name = 'header';
    protected $area = 'HeaderComponent';

    protected string $text = 'Cheerios Magic Dashboard';

    protected IconComponent $settingsIconComponent;

    public function __construct(IconComponent $iconComponent)
    {
        $this->settingsIconComponent = $iconComponent;
    }

    public function getText(): string
    {
        return $this->text;
    }

    protected function applySettings()
    {
        $this->addDataAttr('application-components', json_encode($this->getAllApplications()));
        $this->settingsIconComponent->setIcon('gear');
    }

    protected function getAllApplications()
    {
        return array_map(function($elem) {
            return $elem->getModalComponent()->content(true);
        }, $this->items);
    }

    protected function getSettingsIconComponent(): IconComponent
    {
        return $this->settingsIconComponent;
    }
}