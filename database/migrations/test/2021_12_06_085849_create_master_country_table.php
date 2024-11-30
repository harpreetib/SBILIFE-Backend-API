<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterCountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_country', function (Blueprint $table) {
            $table->integer('counm_id', true);
            $table->string('counm_name')->nullable();
            $table->string('counm_code', 150)->nullable();
            $table->string('counm_iso_code', 20)->nullable();
            $table->integer('counm_orderby')->nullable();
            $table->enum('counm_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_country');
    }
}
