<?php
namespace Src\Components;

trait StyleProps
{
    protected array $extraClasses = [];

    protected string $textSize = 'base';

    protected bool $absolute = false;

    protected string $theme = '';

    protected bool $noWrap = false;

    public function renderExtraClasses(): string
    {
        return implode(' ', $this->extraClasses);
    }

    public function setExtraClasses(array $extraClasses): self
    {
        $this->extraClasses = $extraClasses;
        return $this;
    }

    public function addExtraClass(string $extraClass): self
    {
        $this->extraClasses[] = $extraClass;
        return $this;
    }

    /**
     * @param string $textSize
     * @return Component|StyleProps
     */
    public function setTextSize(string $textSize): self
    {
        $this->textSize = $textSize;
        return $this;
    }

    public function getTextSize(): string
    {
        return $this->textSize;
    }

    /**
     * @return string
     */
    public function renderTextSize(): string
    {
        return 'text-' . $this->textSize;
    }

    /**
     * @param bool $absolute
     * @return Component|StyleProps
     */
    public function setAbsolute(bool $absolute): self
    {
        $this->absolute = $absolute;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAbsolute(): bool
    {
        return $this->absolute;
    }

    /**
     * @param string $theme
     * @return self
     */
    public function setTheme(string $theme): self
    {
        $this->theme = $theme;
        return $this;
    }

    /**
     * @return string
     */
    public function getTheme(): string
    {
        return $this->theme;
    }

    /**
     * @param bool $val
     * @return $this
     */
    public function setNoWrap(bool $val): self
    {
        $this->noWrap = $val;
        return $this;
    }

    /**
     * @return bool
     */
    public function isNoWrap(): bool
    {
        return $this->noWrap;
    }

}