<?php
namespace Src\Classes;

use DateTime;

class StringUtils
{
    public static function endsWith(string $string, string $substr): bool
    {
        return substr($string, -strlen($substr)) == $substr;
    }

    public static function startsWith(string $string, string $substr): bool
    {
        return strpos($string, $substr) === 0;
    }

    public static function stripChars(string $string, string|array $chars): string
    {
        if (!is_array($chars)) {
            $chars = [$chars];
        }

        foreach ($chars as $char) {
            $string = trim($string, $char);
        }

        return $string;
    }

    public static function getDayOfWeek(string $date, bool $italian = false): string
    {
        $day = date('l', strtotime($date));

        return !$italian ? $day : [
            'Monday' => 'Lunedì',
            'Tuesday' => 'Martedì',
            'Wednesday' => 'Mercoledì',
            'Thursday' => 'Giovedì',
            'Friday' => 'Venerdì',
            'Saturday' => 'Sabato',
            'Sunday' => 'Domenica'
        ][$day];
    }

    public static function getTimeFromDate(DateTime $time): string
    {
        return $time->format('H:i');
    }

    public static function sumTimes($time1, $time2): string
    {
        list($hours1, $minutes1) = explode(':', $time1);
        list($hours2, $minutes2) = explode(':', $time2);

        $totalMinutes = ($hours1 * 60 + $minutes1) + ($hours2 * 60 + $minutes2);
        $hours = intdiv($totalMinutes, 60);
        $minutes = $totalMinutes % 60;

        return sprintf('%02d:%02d', $hours, $minutes);
    }

    public static function hashPassword(string $password = ''): string
    {
        return hash(
            'sha256',
            hash('sha256', $password) . $_ENV['PASSWORD_SALT']
        );
    }

    public static function toString(string $input): string
    {
        return $input;
    }

    public static function toInt(string $input): int
    {
        return intval($input);
    }

    public static function toFloat(string $input): float
    {
        return floatval($input);
    }

    public static function jsonToArray(string $input): array
    {
        return json_decode($input);
    }

    public static function addHostToUrl(string $url, bool $addProtocol = false): string
    {
        if (!self::startsWith($url, '/')) {
            $url = "/$url";
        }

        $currentHost = $_SERVER['HTTP_HOST'];
        $protocol = $addProtocol ? self::getCurrentProtocol() . '://' : '';

        return $protocol . $currentHost . $url;
    }

    public static function getCurrentProtocol(): string
    {
        $https = $_SERVER['HTTPS'] ?? '';
        if ('on' == $https) {
            return 'https';
        }

        return 'http';
    }

    public static function getUrlPattern(string $path): string
    {
        $pattern = preg_replace('/\{(\w+)\}/', '(?P<\1>[^/]+)', $path);
        return '#^' . trim($pattern, '/') . '/?$#';
    }
}