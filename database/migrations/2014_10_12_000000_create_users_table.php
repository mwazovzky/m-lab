<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('slug')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->enum('role', ['reader', 'writer', 'admin'])->default('reader');
            $table->enum('country', ['Russia', 'USA', 'undefined'])->default('undefined');
            $table->string('confirmation_token', 25)->nullable()->unique();
            $table->string('avatar_path')->nullable();
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
