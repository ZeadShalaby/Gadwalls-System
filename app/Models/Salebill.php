<?php

namespace App\Models;

use App\Models\User;
use App\Models\Store;
use App\Enums\TaxEnums;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Salebill extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'store_id',
        'product_id',
        'user_id',
        'salary',
        'notes',
        'total',
        'quantity',
        'type_discount',
        'type_payment'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Method to get the name from the selected_option value (number)
    public static function getOptionNameByValue($value)
    {
        return TaxEnums::tryFrom($value)?->name ?? 'Unknown Option';
    }

}
