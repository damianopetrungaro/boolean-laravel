<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Genre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get data-Restaurants from DB
        $restaurants = Restaurant::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->get();

        $genres = Genre::all();

        return view('admin.restaurants.index', compact('restaurants', 'genres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = Genre::all();
        // dd($genres);

        return view('admin.restaurants.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        //VALIDAZIONE
        $request->validate($this->ruleValidation());

        // Salvare immagine in locale
        if(!empty($data['path_img'])){
            $data['path_img'] = Storage::disk('public')->put('images' , $data['path_img']);
        }

        //SALVO DATI A DB
        $data['user_id'] = Auth::id(); //attraverso AUTH generiamo lo slug del ristorante nella fase di autenticazione.

        $data['slug'] = Str::slug($data['name'], '-');

        $newRestaurant = new Restaurant();
        $newRestaurant->fill($data);  //Facciamo fillable nel model!!!

        $saved = $newRestaurant->save();

        if($saved) {

            if(!empty($data['genres'])) {
                $newRestaurant->genres()->attach($data['genres']);
            }

            return redirect()->route('admin.restaurants.index');
        } else {
            return redirect()->route('admin.home');
        } //DA RIVEDERE ERRORS...
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->first();

        return view('admin.restaurants.show', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        $genres = Genre::all();

        return view('admin.restaurants.edit', compact('restaurant', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        //Dati inviati dalla form di aggiornamento
        $data = $request->all();

        ///VALIDAZIONE
        $request->validate($this->ruleValidation());

        //SLUG
        $data['slug'] = Str::slug($data['name'], '-');

        // Salvare immagine in locale
        if(!empty($data['path_img'])) {

            //Cancella l'immagine eventualmente precedente
            if(!empty($restaurant->path_img)) {
                Storage::disk('public')->delete($restaurant->path_img);
            }
            $data['path_img'] = Storage::disk('public')->put('images', $data['path_img']);
        }


        //AGGIORNO DATI A DB
        // $data['user_id'] = Auth::id(); //attraverso AUTH generiamo lo slug del ristorante nella fase di autenticazione.

        // $newRestaurant = new Restaurant();
        // $newRestaurant->fill($data);  //Facciamo fillable nel model!!!

        $updated = $restaurant->update($data);

        if($updated) {

            if (!empty($data['genres'])) {
                //Sincronizza con precedenti generi indicati
                $restaurant->genres()->sync($data['genres']);
            } else {
                //Se non c'è sync con precedenti generi indicati elimina i vecchi
                $restaurant->genres()->detach();
            }

            return redirect()->route('admin.restaurants.index');
        } else {
            return redirect()->route('admin.home');
        } //DA RIVEDERE ERRORS...
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        $ref = $restaurant->name;
        $image = $restaurant->path_img;

        $restaurant->genres()->detach();

        $deleted = $restaurant->delete();

        if($deleted) {
            if(!empty($image)) {
                Storage::disk('public')->delete($image);
            }
            return redirect()->route('admin.restaurants.index')->with('deleted', $ref);
        } else {
            return redirect()->route('admin.home');
        }

    }

    //UTILITY FUNCTIONS
    private function ruleValidation() {
        return [
            //QUA STABILIAMO LE INFO RICHIESTE PER PROCEDERE
            'name' => 'required | max: 100',
            // 'slug'=>notnull();
            'email' => 'required | max: 50',
            'phone_number' => 'required | max: 30',
            'vat_number' => 'required | max: 11',
            'address' => 'required | max: 50',
            'description' => 'required',
            'path_img' => 'image',
        ];
    }
}


