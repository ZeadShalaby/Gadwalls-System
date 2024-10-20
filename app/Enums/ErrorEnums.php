<?php

namespace App\Enums;

enum ErrorEnums: string
{
    case SUCCESS = '1';
    case ERROR = '2';


    /**
     * Get all the enum Gender as an associative array.
     *
     * @return array
     */
    public static function Genders(): array
    {
        return [
            self::SUCCESS->name => '1',
            self::ERROR->name => '2',
        ];
    }
}
