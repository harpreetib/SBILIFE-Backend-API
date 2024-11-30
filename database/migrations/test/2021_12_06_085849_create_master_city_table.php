<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterCityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_city', function (Blueprint $table) {
            $table->integer('cm_id', true);
            $table->integer('counm_id')->nullable()->comment('master_country');
            $table->integer('sm_id')->nullable()->comment('from state_master');
            $table->string('cm_name')->nullable();
            $table->enum('cm_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_city');
    }
}
