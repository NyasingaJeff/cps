<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            //delete a task after its done or change the status
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('phone');
            $table->text('location');
            $table->text('destination');
            $table->string('no_plate');
            $table ->boolean('status');
            $table->timestamps();
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
        Schema::dropIfExists('tasks');
    }
}
