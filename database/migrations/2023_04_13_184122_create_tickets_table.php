<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stuff_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->string('vehicle_category_id')->nullable()->references('id')->on('vehicle_categories')->onDelete('cascade');
            $table->float('amount')->nullable();
            $table->string('image')->nullable();
            $table->enum('status',['entry','return'])->nullable();
            $table->enum('paid_by',[1,2])->nullable();
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
        Schema::dropIfExists('tickets');
    }
}
