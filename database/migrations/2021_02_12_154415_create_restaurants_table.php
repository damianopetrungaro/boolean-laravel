<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name', 100)->notnull();
            $table->string('slug')->notnull();
            $table->string('email', 50)->notnull()->unique();
            $table->string('phone_number', 30)->notnull()->unique();
            $table->string('vat_number', 11)->notnull();
            $table->string('address', 50)->notnull();
            $table->text('description')->notnull();
            $table->string('path_img')->nullable();
            $table->string('visible', 5)->default(1);
            $table->timestamps();

            //Relazione RESTAURANT - USER UR
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
}
