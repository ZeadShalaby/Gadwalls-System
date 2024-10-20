<?php

namespace App\Enums;

enum TaxEnums: string
{
    case TAXINCLUDED = '1';          // ? price - tax
    case TAXEXCLUDED = '2';          // ? price + tax
    case AFTERTAX = '3';             // ? (price + tax ) - discount
    case BEFORETAX = '4';            // ? (price - tax ) + discount
    case WOW = '5';     //? Warranty of Working.   ( value )

    case FRW = '6';     //? Flat Rate Warranty of working.  ( percentage %  )

    /**
     * Get all the enum Gender as an associative array.
     *
     * @return array
     */
    public static function Genders(): array
    {
        return [
            self::TAXINCLUDED->name => '1',
            self::TAXEXCLUDED->name => '2',
            self::AFTERTAX->name => '3',
            self::BEFORETAX->name => '4',
            self::WOW->name => '5',
            self::FRW->name => '6',
        ];
    }
}
