<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('name', 55)->notnull();
            $table->float('last_name', 55)->notnull();
            $table->string('phone_number', 30)->notnull();
            $table->string('email', 50)->notnull();
            $table->string('address', 50)->notnull();
            $table->string('payed', 3)->notnull();
            $table->timestamps();

            //Relazione ORDER - UI
            $table->foreign('order_id')
            ->references('id')
            ->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uis');
    }
}
