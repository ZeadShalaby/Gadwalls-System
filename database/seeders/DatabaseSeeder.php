<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Store;
use App\Models\Product;
use App\Enums\RoleEnums;
use App\Models\Salebill;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);




        //? Supplier
        $defSupplier = Supplier::factory()->create([
            'name' => 'supplier',
            'email' => 'supplier@gmail.com',
            'password' => 'Supplier*',
            'role' => RoleEnums::SUPPLIERS->value,
        ]);

        //? Users
        $defUser = User::factory()->create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => 'User10**',
            'role' => RoleEnums::USER->value,
        ]);


        //? Create 20 Author
        $user = User::factory()->count(79)->create();
        $user->push($defUser);

        //? Create 9 Admin
        $supplier = Supplier::factory()->count(14)->create();
        $supplier->push($defSupplier);

        //? Create 10 Stores
        Store::factory()->count(40)->create();

        //? Create 15 Products
        Product::factory()->count(100)->create();

        //? Create 20 Salebills
        Salebill::factory()->count(60)->create();


    }
}
