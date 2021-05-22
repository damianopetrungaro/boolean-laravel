<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    //MASS ASSIGNMENT
    public $timestamps = false;

    //Questo permette a laravel di non creare in automatico created_at & updated_at
    protected $fillable = [
        'type',
        'img',
    ];

    //Relazione del DB: GENRES - RESTAURANTS

    public function Restaurants()
    {
        return $this->belongsToMany(Restaurant::class);
    }
}
