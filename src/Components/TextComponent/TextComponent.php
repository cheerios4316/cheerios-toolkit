<?php

namespace Src\Components\TextComponent;

use Src\Components\Component;

class TextComponent extends Component
{
    protected string $text = '';
    protected string $textSize = 'base';

    /**
     * @param string $text
     * @return $this
     */
    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }
}