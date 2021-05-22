<?php

use Illuminate\Database\Seeder;
use App\Genre;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $genres = [
            [
                'type' => 'Pizzeria',
                'img' => 'pizza'
            ],
            [
                'type' => 'Piadineria',
                'img' => 'piandina'
            ],
            [
                'type' => 'Gelateria',
                'img' => 'gelato'
            ],
            [
                'type' => 'Indiano',
                'img' => 'indiano'
            ],
            [
                'type' => 'Cinese',
                'img' => 'cinese'
            ],
            [
                'type' => 'Giapponese',
                'img' => 'giapponese'
            ],
            [
                'type' => 'Messicano',
                'img' => 'messicano'
            ],
            [
                'type' => 'Poke',
                'img' => 'poke'
            ],
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }
}
