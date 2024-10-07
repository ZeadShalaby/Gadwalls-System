<?php

namespace App\Enums;

enum StoreTypeEnums: string
{
    case SERVICE = '1';
    case COMPLEX = '2';
    case INVENTORY = '3';


    /**
     * Get all the enum Gender as an associative array.
     *
     * @return array
     */
    public static function Genders(): array
    {
        return [
            self::SERVICE->name => '1',
            self::COMPLEX->name => '2',
            self::INVENTORY->name => '3',
        ];
    }
}
