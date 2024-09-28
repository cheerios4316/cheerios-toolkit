<?php

namespace Src\Components\TextComponent\TextSeparatorComponent;

use Src\Components\TextComponent\TextComponent;

class TextSeparatorComponent extends TextComponent
{
    protected $name = 'text_separator';
    protected $area = 'TextComponent/TextSeparatorComponent';

    protected ?string $id = null;

    protected bool $noWrap = true;

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }
}