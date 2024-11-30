<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1ConferenceSessionMasterMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_conference_session_master_mapping', function (Blueprint $table) {
            $table->integer('csmm_id', true);
            $table->integer('csm_id')->comment('from conference_session_master');
            $table->integer('lemm_id')->comment('from 1_lead_event_master_mapping');
            $table->integer('am_id')->comment('from activity_master');
            $table->integer('aem_id');
            $table->string('csmm_ip')->nullable();
            $table->dateTime('csmm_create_date')->useCurrent();
            $table->enum('csmm_status', ['active', 'inactive'])->default('inactive');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_conference_session_master_mapping');
    }
}
