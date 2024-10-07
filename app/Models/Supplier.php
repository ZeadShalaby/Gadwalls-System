<?php

namespace App\Models;

use App\Models\Store;
use App\Enums\RoleEnums;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory, HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tax',
        'address',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
    ];

    /**
     * Automatically hash the password when setting it.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    public function getRoleName()
    {
        $roles = [
            RoleEnums::SUPPLIERS->value => 'Suppliers',
            RoleEnums::USER->value => 'User',
        ];

        return $roles[$this->role] ?? 'Unknown';
    }
}
