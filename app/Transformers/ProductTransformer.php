<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * @param \App\ProductTransformer $productTransformer
     * @return array
     */
    public function transform(int $response): array
    {
        return [
            'status' => true,
            'errnum' => "S000",
            'time' => $response,
            'message' => "Uploading Files Successfully."
        ];
    }
}