<?php

namespace App\Enums;

enum RoleEnums: string
{
    case SUPPLIERS = '1';
    case USER = '2';

    /**
     * Get all the enum Gender as an associative array.
     *
     * @return array
     */
    public static function Genders(): array
    {
        return [
            self::SUPPLIERS->name => '1',
            self::USER->name => '2',
        ];
    }
}
