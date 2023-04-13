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

            $table->foreignId('toll_id')->nullable()->references('id')->on('tolls')->onDelete('cascade');
            $table->foreignId('shift_id')->nullable()->references('id')->on('shifts')->onDelete('cascade');
            $table->string('stuff_id')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            
            $table->string('password');
            $table->string('profile_picture')->nullable();
            $table->string('lat')->nullable();
            $table->string('lang')->nullable();
            
            $table->boolean('status')->default(0);
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
