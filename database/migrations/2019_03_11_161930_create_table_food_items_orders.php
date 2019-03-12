<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFoodItemsOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_item_order', function (Blueprint $table) {
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('food_item_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('food_item_id')->references('id')->on('food_items');
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
        Schema::dropIfExists('food_items_orders');
    }
}
