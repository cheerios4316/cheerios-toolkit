<?php
namespace Src\Classes;
use Exception;

class JsonReader {
    private string $path = '';

    public function setPath(string $path): self
    {
        $this->path = $path;
        return $this;
    }

    public function getData() {
        if (!file_exists($this->path)) {
            return ['no file'];
        }

        $jsonContent = file_get_contents($this->path);
        $dataArray = json_decode($jsonContent, true); // true for associative array

        if (json_last_error() !== JSON_ERROR_NONE) {
            return [];
        }

        return $dataArray;
    }
}