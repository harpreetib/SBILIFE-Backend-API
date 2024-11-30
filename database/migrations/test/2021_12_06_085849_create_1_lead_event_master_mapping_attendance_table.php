<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1LeadEventMasterMappingAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_lead_event_master_mapping_attendance', function (Blueprint $table) {
            $table->integer('lemma_id', true);
            $table->integer('lemm_id')->nullable();
            $table->timestamp('lemma_datetime')->nullable()->useCurrent();
            $table->dateTime('lemma_last_seen')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_lead_event_master_mapping_attendance');
    }
}
