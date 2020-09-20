<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();

            $table->string('name')->default('central');
            $table->string('lat')->default('1500');
            $table->string('lng')->default('1500');
            $table->string('country')->default('iren');
            $table->string('province')->default('tehran');
            $table->string('city')->default('tehran');
            $table->string('address')->default('tehran azadi Square');
            $table->string('phone')->nullable();
            $table->string('radius')->default('500');
            $table->string('geographical')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('addresses');
    }
}
