<?php

namespace Src\Components\EmptyComponent;
use Src\Components\Component;
use Src\Components\FooterComponent\FooterComponent;

class EmptyComponent extends Component
{
    protected $name = 'empty';
    protected $area = 'EmptyComponent';

    protected $footerComponent;

    public function __construct(FooterComponent $footerComponent)
    {
        $this->footerComponent = $footerComponent;
    }
}