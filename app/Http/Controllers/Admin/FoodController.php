<?php

namespace App\Http\Controllers\Admin;

use App\Food;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminFoodRequest;
use App\Services\ImageStore;
use App\Services\SlugWithDash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods = Food::where('restaurant_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.foods.index', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.foods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(
        AdminFoodRequest $request,
        ImageStore $imageStore,
        SlugWithDash $slugWithDash
    )
    {
        $data = $request->all();
        $data['restaurant_id'] = Auth::id();
        $data['slug'] = $slugWithDash($data['name']);
        if (!empty($data['path_img'])) {
            $data['path_img'] = $imageStore->save($request->file('path_img'));
        }

        $food = new Food();
        $food->fill($data);

        if ($food->save()) {
            return redirect()->route('admin.foods.index');
        }

        return redirect()->route('admin.home');
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function show(string $slug)
    {
        $food = Food::where('slug', $slug)->first();

        return view('admin.foods.show', compact('food'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Food $food): View
    {
        return view('admin.foods.edit', compact('food'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        AdminFoodRequest $request,
        Food $food,
        ImageStore $imageStore,
        SlugWithDash $slugWithDash): RedirectResponse
    {
        $data = $request->all();
        $data['path_img'] = $imageStore->replace($food->path_img, $request->file('path_img'));
        $data['restaurant_id'] = Auth::id();
        $data['slug'] = $slugWithDash($data['name']);

        $newFood = new Food();
        $newFood->fill($data);

        if ($food->update($data)) {
            return redirect()->route('admin.foods.index');
        }

        return redirect()->route('admin.home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food, ImageStore $imageStore): RedirectResponse
    {
        if (!$food->delete()) {
            return redirect()->route('admin.home');
        }

        if (!empty($image)) {
            $imageStore->delete($image);
        }

        return redirect()->route('admin.foods.index')->with('deleted', $food->name);

    }
}
