<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_state', function (Blueprint $table) {
            $table->integer('sm_id', true);
            $table->integer('counm_id')->nullable()->comment('from country_master');
            $table->string('sm_name', 100)->nullable();
            $table->enum('sm_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_state');
    }
}
