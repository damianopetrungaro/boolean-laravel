<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ui extends Model
{
    //Relazione del DB: UI - ORDER
    public function Order() {
        return $this->belongsTo('App\Order');
    }
}
