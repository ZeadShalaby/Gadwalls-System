<?php

namespace App\Services;

use App\Enums\TaxEnums;

class PriceCalculator
{
    public const TAX_INCLUDED = TaxEnums::TAXINCLUDED->value;
    public const TAX_EXCLUDED = TaxEnums::TAXEXCLUDED->value;

    public const AFTER_TAX = TaxEnums::AFTERTAX->value;
    public const BEFORE_TAX = TaxEnums::BEFORETAX->value;
    public const WOW = TaxEnums::WOW->value;
    public const FRW = TaxEnums::FRW->value;

    public function calculate($price, $tax, $discount, $selectedOption, $taxOption)
    {
        // if ($discount > 0) {
        //     $price = $price - $discount;
        // }
        // if ($taxOption === self::TAX_INCLUDED) {
        //     $price = $price + $tax;
        // } elseif ($taxOption === self::TAX_EXCLUDED) {
        //     $price = $price + $tax;
        // }

        switch ($selectedOption) {
            case self::AFTER_TAX:
                return ($price + $tax) - $discount;
            case self::BEFORE_TAX:
                return ($price - $discount) + $tax;
            case self::WOW:
                return $this->warrantyWorking($price);
            case self::FRW:
                return $this->flatRateWarranty($price, $discount);
            default:
                throw new \InvalidArgumentException("Invalid selected option");
        }
    }

    private function warrantyWorking($price)
    {
        return $price;
    }

    private function flatRateWarranty($price, $percentage)
    {
        return $price * ($percentage / 100);
    }
}
