<?php

namespace Src\AutoCacher;

use Src\Container\Container;

class AutoCacher
{
    protected static array $keys = [];

    protected static string $cacheFilesPath = '/src/Autocacher/cache_files';

    public function get(string $key)
    {
        if (!file_exists($filename = $this->getPath() . '/' . $key . '.php')) {
            return null;
        }

        $element = include $filename;

        if($element->isExpired()) {
            unlink($filename);
        }

        return $element->getValue();

    }

    public function set(string $key, mixed $val, int $expire = 600): self
    {
        $elem = Container::getInstance()->create(CachedElement::class);
        $elem->setValue($val)->setExpire($expire);

        $this->save($key, $elem);

        return $this;
    }

    protected function save(string $key, CachedElement $elem)
    {
        if(!is_dir($this->getPath())) {
            mkdir($this->getPath());
        }

        $serializedObject = base64_encode(serialize($elem));
        $content = '<?php return unserialize(base64_decode(\'' . $serializedObject . '\')); ?>';
        file_put_contents($this->getPath() . '/' . $key . '.php', $content);
    }

    protected function getPath(): string
    {
        return $_SERVER['DOCUMENT_ROOT'] . self::$cacheFilesPath;
    }
}