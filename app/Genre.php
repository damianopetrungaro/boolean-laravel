<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    //MASS ASSIGNMENT
    protected $fillable = [
        'type',
        'img',
    ];

    //Questo permette a laravel di non creare in automatico created_at & updated_at
    public $timestamps = false;

    //Relazione del DB: GENRES - RESTAURANTS
    public function Restaurants() {
        return $this->belongsToMany('App\Restaurant');
    }
}
