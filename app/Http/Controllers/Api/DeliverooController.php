<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Genre;
use App\Food;

class DeliverooController extends Controller
{
    public function index(Request $request) 
    {
        $data = $request->all();
        if(empty($data['genre'])) {

            $restaurants = DB::table('restaurants')
            ->orderBy('created_at', 'asc')
            ->get();
        }
        elseif (!empty($data['genre'])) 
        {
            $restaurants = [];
            $genresId = [];

            $genresId = $data['genre'];
            foreach ($genresId as $genre) {
                $restaurants = Restaurant::whereHas('genres', function($q) use ($genresId) 
                {
                    $q->whereIn('type', $genresId);
                }, '=', count($genresId))->get();
            }
        }
        return response()->json($restaurants);
    }

    public function food() {
        $foods = Food::all();
        return response()->json($foods);
    }

    public function genre() {
        $genres = Genre::all();
        return response()->json($genres);
    }

}
