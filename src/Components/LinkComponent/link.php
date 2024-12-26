<?php

namespace Src\Components\LinkComponent;

/**
 * @var LinkComponent $this;
 */

?>

<div class="link-component">
    <a href="<?= $this->getHref() ?>" <?= $this->isTargetBlank() ? 'target="_blank"' : '' ?>><?= $this->getText() ?></a>
</div>