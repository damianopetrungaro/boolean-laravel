<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    //MASS ASSIGNMENT
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone_number',
        'vat_number',
        'address',
        'description',
        'path_img',
        'slug',
    ];


    //Relazione del DB: RESTAURANT - USERS
    public function User() {
        return $this->belongsTo('App\User');
    }

    //Relazione del DB: RESTAURANT - FOODS
    public function Foods() {
        return $this->hasMany('App\Food');
    }

    //Relazione del DB: RESTAURANTS - GENRES 
    public function Genres() {
        return $this->belongsToMany('App\Genre');
    }
}
