<?php

namespace Src\Components\PageComponent\HomePageComponent;

use Src\Components\InternalApplications\SearchEnginesModalComponent\SearchEnginesModalComponent;
use Src\Components\InternalApplications\SettingsModalComponent\SettingsModalComponent;
use Src\Container\Container;

/**
 * @var HomePageComponent $this
 */

?>

<div class="home-page-component h-screen ">
    <?php $this->getHeaderComponent()->render() ?>
    <div class="page-content h-full">
    </div>
</div>