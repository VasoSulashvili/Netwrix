<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loc_state', function (Blueprint $table) {
            $table->increments('state_id');
            $table->unsignedInteger('country_id');
            $table->string('name', 255);
            $table->string('short_name', 50)->default(null);

            $table->foreign('country_id')->references('country_id')->on('loc_country');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loc_state');
    }
};
