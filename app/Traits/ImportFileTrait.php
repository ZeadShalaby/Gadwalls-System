<?php

namespace App\Traits;

use App\Models\Product;
use App\Jobs\ProductImport;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ImportErrorNotification;


trait ImportFileTrait
{
    private function hasMissingFields($row)
    {
        return empty($row[0] || $row[1] || $row[2] || empty($row[4] || empty($row[5] || empty($row[6]))));
    }

    private function isDuplicateEntry($code)
    {
        return Product::where('code', $code)->exists() || empty($code);
    }

    private function prepareProductData($row)
    {
        return [
            'name' => $row[0],
            'supplier_id' => $row[1],
            'store_id' => $row[2],
            'code' => $row[3],
            'quantity' => $row[4],
            'expire_date' => $row[5],
            'price' => $row[6],
        ];
    }

    private function notifyUser($message, $row)
    {
        $rowInfo = [
            'name' => $row[2] ?? 'N/A',
            'academic_number' => $row[4] ?? 'N/A',
        ];
        Notification::send(auth()->user(), new ImportErrorNotification($message, $rowInfo));
    }

    public function createProducts($data)
    {
        $count = 0;
        foreach ($data as $index => $row) {
            //? Validate required fields
            if ($this->hasMissingFields($row)) {
                $this->notifyUser('Missing required fields.', $row);
                continue;
            }

            //? Validate Duplicate code
            if ($this->isDuplicateEntry($row[3]) || Product::where('code', $row[3])->exists()) {
                $this->notifyUser('Duplicate entry for code: ' . $row[3], $row);
                continue;
            }

            try {
                Bus::chain([new ProductImport($this->prepareProductData($row))])
                    ->delay(now()->addSeconds($index * 2))
                    ->dispatch();
                $count++;
            } catch (\Exception $e) {
                $this->notifyUser($e->getMessage(), $row);
                continue;
            }
        }

        // Return success notification
        return $count;
    }
}







