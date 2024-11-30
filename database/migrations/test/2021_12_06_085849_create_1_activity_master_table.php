<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1ActivityMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_activity_master', function (Blueprint $table) {
            $table->integer('am_id', true);
            $table->enum('am_is_activity_against_exhibitor', ['Y', 'N'])->nullable()->default('Y');
            $table->string('am_text')->nullable();
            $table->integer('am_point')->nullable();
            $table->dateTime('am_starttime')->nullable();
            $table->dateTime('am_endtime')->nullable();
            $table->string('am_desc')->nullable();
            $table->enum('am_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_activity_master');
    }
}
