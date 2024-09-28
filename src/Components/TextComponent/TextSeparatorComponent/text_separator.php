<?php

use Src\Components\TextComponent\TextSeparatorComponent\TextSeparatorComponent;

/**
 * @var TextSeparatorComponent $this
 */

?>

<div class="text-separator-component flex items-center pb-4 <?= $this->getId() ? 'id="' . $this->getId() . '"' : '' ?> sm:flex-nowrap flex-wrap">
    <div class="border-t border-blue-950 flex-grow w-full sm:w-auto"></div>
    <div class="mx-8 text-4xl <?= $this->isNoWrap() ? 'whitespace-nowrap' : 'text-center w-[55rem] sm:w-auto' ?> max-w-full sm:max-w-screen-sm text-center"><?= $this->getText() ?></div>
    <div class="border-t border-blue-950 flex-grow w-full sm:w-auto"></div>
</div>

