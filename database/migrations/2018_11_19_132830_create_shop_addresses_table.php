<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address', 100)->nullable(true);
            $table->string('street_one', 100)->nullable(true);
            $table->string('street_two', 100)->nullable(true);
            $table->string('latitude', 100)->nullable(true);
            $table->string('longitude', 100)->nullable(true);
            $table->string('zip_code', 100)->nullable(true);
            $table->string('city', 100)->nullable(false);
            $table->string('country', 100)->nullable(false);
            $table->unsignedInteger('shop_id');
            $table->timestamps();
            $table->foreign('shop_id')->references('id')->on('shops');
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
        Schema::dropIfExists('shop_addresses');
    }
}
