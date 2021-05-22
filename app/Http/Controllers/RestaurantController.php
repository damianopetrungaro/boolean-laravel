<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\Food;

class RestaurantController extends Controller
{
    public function index() {
        $restaurants = Restaurant::orderBy('id', 'asc')->get();
        
        return view('guests.home', compact('restaurants'));
    }

    public function show($slug) {
        $restaurant = Restaurant::where('slug', $slug)->first();
        $foods = Food::all();

        if (empty($restaurant)) {
            abort(404);
        } //DA PERSONALIZZARE

        return view('guests.restaurants.show', compact('restaurant', 'foods'));
    }

    public function payed()
    {
        return view('guests.payed');
    }
}
