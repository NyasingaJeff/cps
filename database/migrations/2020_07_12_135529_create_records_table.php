<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_plate');      
            $table->string('name');
            $table->integer('space_id')->unsigned();           
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('space_id')->references('id')->on('spaces');
            $table->foreign('no_plate')->references('no_plate')->on('clients');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
}
