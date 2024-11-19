<?php

namespace Src\Components\InputComponent;

/**
 * @var InputComponent $this;
 */

?>

<input type="<?= $this->getInputType() ?>" name="<?= $this->getInputName() ?>"
    placeholder="<?= $this->getPlaceholder() ?>">