<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Faker\Factory as Faker;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $faker->addProvider(new \FakerRestaurant\Provider\id_ID\Restaurant($faker));
        $faker->addProvider(new \Liior\Faker\Prices($faker));

        for ($i=1; $i <= 10 ; $i++) { 
            DB::table('menus')->insert([
                // 'id_category' => Category::all()->random()->id,
                'id_category' => $faker->randomElement([1, 2, 3]),
                'name' => $faker->foodName(),
                'price' => $faker->price(10000, 20000, true, false),
            ]);
        }
    }
}
