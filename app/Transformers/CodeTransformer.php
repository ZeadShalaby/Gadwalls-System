<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class CodeTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($product)
    {
        return [
            'product_name' => $product->name,
            'quantity' => $product->quantity,
            'price' => $product->price,
            'store' => $product->store->name,
            'supplier' => $product->supplier ? $product->supplier->name : null,
            'supplier_id' => $product->supplier_id,
            'store_id' => $product->store_id
        ];
    }
}
