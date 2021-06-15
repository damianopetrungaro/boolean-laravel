<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\View\View;

class RestaurantController extends Controller
{
    public function index(): View
    {
        $restaurants = Restaurant::orderBy('id', 'asc')->get();

        return view('guests.home', compact('restaurants'));
    }

    public function show(Restaurant $restaurant): View
    {
        return view('guests.restaurants.show', compact('restaurant'));
    }
}
