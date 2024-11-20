<?php

namespace Src\Classes;

class StringCaster
{
    public static function toString(string $input): string {
        return $input;
    }

    public static function toInt(string $input): int {
        return intval($input);
    }

    public static function toFloat(string $input): float {
        return floatval($input);
    }

    public static function jsonToArray(string $input): array {
        return json_decode($input);
    }
}