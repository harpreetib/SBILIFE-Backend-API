<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1EventActivityPointsMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_event_activity_points_mapping', function (Blueprint $table) {
            $table->integer('eapm_id', true);
            $table->integer('am_id');
            $table->integer('aem_id');
            $table->string('eapm_point');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_event_activity_points_mapping');
    }
}
