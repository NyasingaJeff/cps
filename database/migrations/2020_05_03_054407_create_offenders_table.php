<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offenders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_plate');
            $table->string('location');      
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->string('color')->nullable();
            $table->integer('crime_id')->unsigned();
            $table->boolean('status');
            $table->timestamps();
            $table->foreign('crime_id')->references('id')->on('crimes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offenders');
    }
}
