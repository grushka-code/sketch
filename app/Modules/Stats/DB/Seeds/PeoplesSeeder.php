<?php

namespace App\Modules\Stats\DB\Seeds;

use App\Modules\Stats\Models\Products\Prices;
use App\Modules\Stats\Models\Products\Products;
use App\Modules\Stats\Models\Regions\Peoples;
use App\Modules\Stats\Models\Regions\Region;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeoplesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            "Vinnytsia",
            "Lutsk",
            "Lysychans'k",
            "Luhansk",
            "Dnipro",
            "Kryvyi Rih",
            "Nikopol",
            "Donetsk",
            "Horlivka",
            "Makiivka",
            "Mariupol",
            "Zhytomyr",
            "Uzhhorod",
            "Melitopol",
            "Sumy",
            "Rivne",
            "Kyiv"

        ];
        foreach ($products as $product) {
            (new Region(['name' => $product]))->save();
        }
        factory(Peoples::class, 300)->create();
    }
}
