<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\User;
use App\Restaurant;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users = User::all();
        foreach ($users as $user) {
            for ($i = 0; $i < 3; $i++) {
                $newRestaurant = new Restaurant();
                $newRestaurant->user_id = $user->id;
                $newRestaurant->name = $faker->words(3, true);
                $newRestaurant->slug = Str::slug($newRestaurant->name, '-');
                $newRestaurant->email = $faker->email();
                $newRestaurant->phone_number = $faker->randomNumber(9, false);
                $newRestaurant->vat_number = $faker->numerify('IT#########');
                $newRestaurant->address = $faker->sentence(2);
                $newRestaurant->description = $faker->text(400);
                $newRestaurant->path_img = $faker->imageUrl(640, 480);
                $newRestaurant->visible = $faker->randomElement([true]);
                $newRestaurant->save();
            }
        }
    }
}
