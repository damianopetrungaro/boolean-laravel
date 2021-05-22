<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Restaurant;
use App\Food;


class FoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $restaurants = Restaurant::all();
        foreach ($restaurants as $restaurant) {
            for ($i = 0; $i < 8; $i++) {
                $newFood = new Food();
                $newFood->restaurant_id = $restaurant->id;
                $newFood->name = $faker->words(3, true);
                $newFood->description = $faker->text(200);
                $newFood->ingredients = $faker->words(10, true);
                $newFood->price = $faker->randomFloat(1, 10, 20);
                $newFood->visibility = $faker->randomElement(['Yes', 'No']);
                $newFood->path_img = $faker->imageUrl(640, 480);
                $newFood->slug = Str::slug($newFood->name, '-');
                $newFood->save();
            }
        }
    }
}
