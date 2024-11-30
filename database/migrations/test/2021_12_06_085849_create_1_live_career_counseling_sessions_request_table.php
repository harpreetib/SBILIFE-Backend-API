<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1LiveCareerCounselingSessionsRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_live_career_counseling_sessions_request', function (Blueprint $table) {
            $table->integer('ruccs_id', true);
            $table->integer('lccs_id')->nullable()->comment('from live_career_counseling_sessions');
            $table->integer('lm_id')->nullable()->comment('from lead_master');
            $table->timestamp('ruccs_insertdate')->nullable()->useCurrent();
            $table->string('ruccs_ip', 120)->nullable();

            $table->unique(['lccs_id', 'lm_id'], 'lccs_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_live_career_counseling_sessions_request');
    }
}
