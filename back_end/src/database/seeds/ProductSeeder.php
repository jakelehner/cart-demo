<?php

namespace App\Database\Seeds;

use App\Models\Product;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /// Start fresh
        DB::table((new Product())->getTable())->delete();

        // Seed Table
        factory(Product::class, 10)->create();
    }
}
