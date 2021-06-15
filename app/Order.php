<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //MASS ASSIGNMENT
    public $timestamps = false;

    //Questo permette a laravel di non creare in automatico created_at & updated_at
    protected $fillable = [
        'total_price',
        'email',
        'address',
    ];

    //Relazione del DB: ORDERS - FOODS

    public function Foods()
    {
        return $this->belongsToMany(Food::class);
    }

    //Relazione del DB: ORDER - UI
    public function Ui()
    {
        return $this->hasOne(Ui::class);
    }
}
