<?php

use Src\Components\IconComponent\IconComponent;
/**
 * @var IconComponent $this
 */

?>

<i class="<?= ($type = $this->getType()) ? 'fa-' . $type : 'fas'?> fa-<?= $this->getIcon() ?>"></i>

