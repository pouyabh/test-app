<?php

namespace App\Enums;


enum UserGender: string
{
    case MALE               = 'MALE';
    case FEMALE             = 'FEMALE';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function info(): array
    {
        return [
            self::maker(
                key: self::MALE->value,
                query: 'status=MALE',
            ),
            self::maker(
                key: self::FEMALE->value,
                query: "status=FEMALE",
            )
        ];
    }

    public function detail()
    {
        return match ($this) {
            self::MALE               => self::maker(
                key: self::MALE->value,
                query: 'status=MALE',
            ),
            self::FEMALE      => self::maker(
                key: self::FEMALE->value,
                query: "status=FEMALE",
            )
        };
    }

    public static function maker(
        $key,
        $endpoint = '',
        $query = '',
    ): array {
        return [
            'key'       => $key,
            'name'      => __("messages." . strtolower($key)),
            'endpoint'  => $endpoint,
            'query'     => $query,
        ];
    }
}
