<?php

namespace App\Enums;


enum CommentStatus: string
{
    case ACTIVE               = 'ACTIVE';
    case INACTIVE             = 'INACTIVE';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function info(): array
    {
        return [
            self::maker(
                key: self::ACTIVE->value,
                query: 'status=ACTIVE',
            ),
            self::maker(
                key: self::INACTIVE->value,
                query: "status=FEMALE",
            )
        ];
    }

    public function detail()
    {
        return match ($this) {
            self::ACTIVE               => self::maker(
                key: self::ACTIVE->value,
                query: 'status=ACTIVE',
            ),
            self::INACTIVE      => self::maker(
                key: self::INACTIVE->value,
                query: "status=INACTIVE",
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
