<?php

namespace App\Http\Controllers\Admin;

use App\Genre;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRestaurantRequest;
use App\Restaurant;
use App\Services\ImageStore;
use App\Services\SlugWithDash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //Get data-Restaurants from DB
        $restaurants = Restaurant::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $genres = Genre::all();

        return view('admin.restaurants.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        AdminRestaurantRequest $request,
        ImageStore $imageStore,
        SlugWithDash $slugWithDash
    ): RedirectResponse
    {
        $data = $request->all();

        // Salvare immagine in locale
        if (!empty($data['path_img'])) {
            $data['path_img'] = $imageStore->save($request->file('path_img'));
        }

        //SALVO DATI A DB
        $data['user_id'] = Auth::id(); //attraverso AUTH generiamo lo slug del ristorante nella fase di autenticazione.

        $data['slug'] = $slugWithDash($data['name']);

        $newRestaurant = new Restaurant();
        $newRestaurant->fill($data);  //Facciamo fillable nel model!!!

        if (!$newRestaurant->save()) {
            return redirect()->route('admin.home');
        }

        if (!empty($data['genres'])) {
            $newRestaurant->genres()->attach($data['genres']);
        }

        return redirect()->route('admin.restaurants.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug): View
    {
        $restaurant = Restaurant::where('slug', $slug)->first();

        return view('admin.restaurants.show', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant): View
    {
        $genres = Genre::all();

        return view('admin.restaurants.edit', compact('restaurant', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        AdminRestaurantRequest $request,
        Restaurant $restaurant,
        ImageStore $imageStore,
        SlugWithDash $slugWithDash): RedirectResponse
    {
        //Dati inviati dalla form di aggiornamento
        $data = $request->all();

        //SLUG
        $data['slug'] = $slugWithDash($data['name']);

        $data['path_img'] = $imageStore->replace($restaurant->path_img, $request->file('path_img'));

        if (!$restaurant->update($data)) {
            return redirect()->route('admin.home');
        }

        if (!empty($data['genres'])) {
            //Sincronizza con precedenti generi indicati
            $restaurant->genres()->sync($data['genres']);
        } else {
            //Se non c'è sync con precedenti generi indicati elimina i vecchi
            $restaurant->genres()->detach();
        }

        return redirect()->route('admin.restaurants.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant, ImageStore $imageStore): RedirectResponse
    {
        $image = $restaurant->path_img;

        $restaurant->genres()->detach();

        if (!$restaurant->delete()) {
            return redirect()->route('admin.home');
        }

        if (!empty($image)) {
            $imageStore->delete($image);
        }

        return redirect()->route('admin.restaurants.index')->with('deleted', $restaurant->name);

    }
}


