<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //MASS ASSIGNMENT
    protected $fillable = [
        'total_price',
        'email',
        'address',
    ];

    //Questo permette a laravel di non creare in automatico created_at & updated_at
    public $timestamps = false;

    //Relazione del DB: ORDERS - FOODS 
    public function Foods() {
        return $this->belongsToMany('App\Food');
    }

    //Relazione del DB: ORDER - UI
    public function Ui() {
        return $this->hasOne('App\Ui');
    }
}
