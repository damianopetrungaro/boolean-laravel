<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Generator as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $newUser = new User();
            $newUser->name = $faker->username();
            $newUser->last_name = $faker->username();
            $newUser->phone_number = $faker->randomNumber(9, false);
            $newUser->password = $faker->randomNumber(8, true);
            $newUser->email = $faker->email();
            $newUser->save();
        }
    }
}
