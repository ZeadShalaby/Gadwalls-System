<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rival extends Model
{
    use HasFactory;


    /* The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rivalable_type',
        'rivalable_id',
        'rival',
        'created_at',
        'updated_at'
    ];


    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public function rivalable()
    {
        return $this->morphTo();
    }

    //    return $this->morphTo(__FUNCTION__, 'imageable_type', 'imageable_id');


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'updated_at',
        'created_at'
    ];


}
