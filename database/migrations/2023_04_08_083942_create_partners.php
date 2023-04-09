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
        Schema::create('partner_locator', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company', 255);
            $table->string('status', 255);
            $table->string('logo', 255);
            $table->string('address', 255);
            $table->string('website', 255);
            $table->string('phone', 40);
            $table->string('countries_covered', 1000);
            $table->string('states_covered', 1000);
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
        Schema::dropIfExists('partner_locator');
    }
};
