<?php

namespace App\Console;

use App\Models\Stock;
use App\Models\Product;
use App\Jobs\StockProduct;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\StockProductCommand;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $products = Product::where('expire_date', '<', now())->get();

            foreach ($products as $index => $item) {
                $existingStock = Stock::where('product_id', $item->id)->exists();

                if (!$existingStock) {
                    // Directly dispatch the StockProduct job with a delay
                    StockProduct::dispatch($item->id)->delay(now()->addSeconds($index * 2));
                }
            }
        })->everyTwoSeconds();

        // $schedule->command('app:stock-product')->everyTwoSeconds();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }
}
