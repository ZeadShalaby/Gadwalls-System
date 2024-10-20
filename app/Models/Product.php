<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Media;
use App\Models\Rival;
use App\Models\Store;
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
        'store_id',
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

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function saleBills()
    {
        return $this->hasMany(Salebill::class);
    }

    public function getExpireDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('Y-m-d') : 'N/A';
    }


    public function increaseQuantity(int $quantity): void
    {
        $this->quantity += $quantity;
        $this->save();
    }

    public function getListMediaAttribute()
    {
        // Ensure $this->media is available and contains list_media
        if ($this->media && $this->media->count() > 0) {
            return json_decode($this->media->first()->list_media, true);
        }
        return []; // Return an empty array if there is no media
    }

    /**
     * الحصول على معرف المنتج بناءً على الكود.
     *
     * @param string $code
     * @return int|null
     */
    public static function getIdByCode(string $code)
    {
        $product = self::where('code', $code)->first();

        return $product ? $product->id : null; // إرجاع الـ id أو null إذا لم يوجد المنتج
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public function media()
    {
        return $this->morphMany(Media::class, 'mediaable');
    }


    public function media_one()
    {
        return $this->morphOne(Media::class, 'mediaable');
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public function rival()
    {
        return $this->morphMany(Rival::class, 'rivalable');
    }


    public function rival_one()
    {
        return $this->morphOne(Rival::class, 'rivalable');
    }


}
