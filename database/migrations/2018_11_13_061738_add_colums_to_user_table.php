<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumsToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('image_path')->after('password')->nullable(true);
            $table->string('image_thumb')->after('image_path')->nullable(true);
            $table->string('phone_number')->after('image_thumb')->nullable(true);
            $table->date('date_of_birth')->after('phone_number')->nullable(true);
            $table->string('gender')->after('date_of_birth')->nullable(true);
            $table->string('description')->after('gender')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('image_path');
            $table->dropColumn('image_thumb');
            $table->dropColumn('phone_number');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('gender');
            $table->dropColumn('description');
        });
    }
}
