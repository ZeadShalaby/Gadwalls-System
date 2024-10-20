<?php

namespace App\Services;

use App\Enums\TaxEnums;
use App\Models\Product;
use App\Models\Salebill;


class SalebillServices
{

    // ?todo create salebill for this orders
    public function create($orders)
    {
        $id = [];
        foreach ($orders as $order) {
            $salebill = Salebill::create([
                'store_id' => $order['store_id'] ?? null,
                'product_id' => Product::getIdByCode($order['code']),
                'user_id' => auth()->id(),
                'salary' => $order['price'],
                'notes' => $order['name'],
                'total' => $order['total'],
                'quantity' => $order['quantity'],
                'type_discount' => !empty($order['selected_option']) ? $order['selected_option'] : TaxEnums::WOW->value,
                'type_payment' => $order['tax_option'] ?? $order['tax_option'] ?? TaxEnums::TAXINCLUDED->value,
            ]);

            $id[] = $salebill->id;

            // ?todo update product quantity
            $product = Product::where('code', $order['code'])->first();
            $product->quantity -= $order['quantity'];
            if ($product->quantity < 0) {
                $product->quantity = 0;
            }
            $product->save();
        }
        return $id;
    }
}