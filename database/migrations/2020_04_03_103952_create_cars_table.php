<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('make_id');
            $table->unsignedBigInteger('model_id');
            $table->year('year');
            $table->unsignedInteger('mileage');
            $table->string('color', 64);
            $table->decimal('price');
            $table->timestamps();

            $table->foreign('make_id')->references('id')->on('car_makes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('model_id')->references('id')->on('car_models')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
