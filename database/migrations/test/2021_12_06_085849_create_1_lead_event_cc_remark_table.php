<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1LeadEventCcRemarkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_lead_event_cc_remark', function (Blueprint $table) {
            $table->integer('lecr_id', true);
            $table->integer('lemm_id')->comment('from lead_event_master_mapping');
            $table->string('lecr_comment')->nullable();
            $table->integer('lecr_comment_by');
            $table->integer('lecr_updateby')->nullable();
            $table->string('lecr_updateby_ip', 120)->nullable();
            $table->timestamp('lecr_insert_date')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_lead_event_cc_remark');
    }
}
