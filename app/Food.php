<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    //MASS ASSIGNMENT
    protected $fillable = [
        'restaurant_id',
        'name',
        'description',
        'ingredients',
        'price',
        'visibility',
        'path_img',
        'slug',
    ];

    //Relazione del DB: FOODS - RESTAURANT
    public function Restaurant() {
        return $this->belongsTo('App\Restaurant');
    }

    //Relazione del DB: FOODS - ORDERS 
    public function Orders() {
        return $this->belongsToMany('App\Order');
    }
}
