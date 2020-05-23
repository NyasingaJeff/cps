<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFinedueToTableOffenders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offenders', function (Blueprint $table) {
            $table->text('fine_due')->after('crime_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offenders', function (Blueprint $table) {
            $table->dropColumn('fine_due');

        });
    }
}
