<?php

namespace Src\Classes;

class StringCaster
{
    public static function castToString(string $input): string {
        return $input;
    }

    public static function castToInt(string $input): int {
        return intval($input);
    }

    public static function castToFloat(string $input): float {
        return floatval($input);
    }

    public static function castJsonToArray(string $input): array {
        return json_decode($input);
    }
}