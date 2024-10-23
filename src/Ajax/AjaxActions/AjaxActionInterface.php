<?php

namespace Src\Ajax\AjaxActions;

interface AjaxActionInterface
{
    public function action(array $params = []): array;

    public function getEndpoint(): string;
}