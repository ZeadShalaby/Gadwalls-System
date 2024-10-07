<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Salebill;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'supplier_id',
        'code',
        'quantity',
        'price',
        'expire_date',
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

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function saleBills()
    {
        return $this->hasMany(Salebill::class);
    }

    public function getExpireDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('Y-m-d') : 'N/A';
    }

}
