<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('restaurant_id');
            $table->string('name', 200)->notnull();
            $table->string('slug')->notnull();
            $table->text('description')->nullable();
            $table->string('ingredients', 255)->notnull();
            $table->float('price', 6,2)->notnull();
            $table->string('visibility', 10)->notnull();
            $table->string('path_img')->nullable();
            $table->timestamps();

            //Relazione RESTAURANT - FOODS
            $table->foreign('restaurant_id')
                  ->references('id')
                  ->on('restaurants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food');
    }
}
