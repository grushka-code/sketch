<?php

namespace App\Modules\Stats\DB\Seeds;

use App\Modules\Stats\Models\Products\Prices;
use App\Modules\Stats\Models\Products\Products;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PricesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            'Apple',
            'Banana',
            'Meat',
            'Nuts',
            'Noodle',
            'Milk',
            'Rice',
            'Chicken',
            'IceCream',
            'Oil',
        ];
        foreach ($products as $product){
            (new Products(['name' => $product]))->save();
        }
        factory(Prices::class, 250)->create();
    }
}
