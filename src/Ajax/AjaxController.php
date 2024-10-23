<?php

namespace Src\Ajax;

use ReflectionClass;
use Src\Ajax\AjaxActions\AjaxActionInterface;
use Src\Container\Container;

class AjaxController
{
    protected static string $pathPrefix = '/ajax/';
    
    protected static array $error404 = ["message" => "Endpoint not found"];
    protected array $endpoints = [];

    protected AjaxActionLoader $ajaxActionLoader;

    public function __construct(AjaxActionLoader $ajaxActionLoader)
    {
        $this->ajaxActionLoader = $ajaxActionLoader;

        $this->loadEndpoints();
    }

    protected function loadEndpoints()
    {
        $this->endpoints = $this->ajaxActionLoader->getEndpoints();
    }

    public function execute(): void
    {
        $endpoint = $this->getEndpoint();

        if(!array_key_exists($endpoint, $this->endpoints)) {
            $this->response(self::$error404, 404);
        }

        /** @var AjaxActionInterface $action */
        $action = Container::getInstance()->create($this->endpoints[$endpoint]);
        
        $params = $this->parseParams();

        $this->response($action->action($params));
    }

    protected function parseParams(): array
    {
        parse_str($_SERVER['QUERY_STRING'], $res);
        return $res;
    }

    protected function getEndpoint(): string
    {
        $full = $_SERVER['REDIRECT_URL'];
        return trim(substr($full, strlen(self::$pathPrefix)), '/');
    }

    protected function response(array $data, int $statusCode = 200): void
    {
        header('Content-Type: application/json');
        http_response_code($statusCode);

        $data = ["status" => $statusCode, ...$data];

        echo json_encode($data);
        exit;
    }
}