<?php

namespace App\Http\Controllers\Api;

use App\Food;
use App\Genre;
use App\Http\Controllers\Controller;
use App\Restaurant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeliverooController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $data = $request->all();
        if (empty($data['genre'])) {
            $restaurants = Restaurant::orderBy('created_at')->get();
        } else {
            $restaurants = Restaurant::whereHas('genres', function ($q) use ($data) {
                $q->whereIn('type', $data['genre']);
            })->get();
        }

        return response()->json($restaurants);
    }

    public function food(): JsonResponse
    {
        $foods = Food::all();
        return response()->json($foods);
    }

    public function genre(): JsonResponse
    {
        $genres = Genre::all();
        return response()->json($genres);
    }

}
