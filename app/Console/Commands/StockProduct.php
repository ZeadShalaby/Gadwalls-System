<?php

namespace App\Console\Commands;

use App\Models\Stock;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;

class StockProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:stock-product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check products for expiration and queue jobs for stock updates';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $products = Product::where('expire_date', '<', now())->get();

        foreach ($products as $index => $item) {
            $existingStock = Stock::where('product_id', $item->id)->exists();

            if (!$existingStock) {
                // Directly dispatch the StockProduct job with a delay
                StockProduct::dispatch($item->id)->delay(now()->addSeconds($index * 2));
            }
        }
    }

}
