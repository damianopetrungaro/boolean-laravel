<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 55)->notnull();
            $table->string('last_name', 55)->notnull();
            $table->string('phone_number', 30)->notnull()->unique();
            $table->string('email')->notnull()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->notnull();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
