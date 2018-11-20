<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image_path')->nullable(false);
            $table->string('image_thumb')->nullable(false);
            $table->enum('main_image', ['true', 'false']);
            $table->unsignedInteger('food_item_id');
            $table->timestamps();
            $table->foreign('food_item_id')->references('id')->on('food_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('food_photos');
    }
}
