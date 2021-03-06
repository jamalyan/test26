<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_models', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->unsignedBigInteger('make_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('make_id')->references('id')->on('car_makes')->onDelete('cascade')->onUpdate('cascade');
            $table->unique(['name', 'make_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_models');
    }
}
