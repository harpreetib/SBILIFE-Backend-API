<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1LeadEventExhibitorMappingActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_lead_event_exhibitor_mapping_activity', function (Blueprint $table) {
            $table->integer('leema_id', true);
            $table->integer('leem_id')->nullable()->comment('from 1_lead_event_exhibitor_mapping');
            $table->integer('lemm_id');
            $table->integer('tageted_lemmid')->comment('only for network ');
            $table->integer('am_id')->nullable()->comment('from activity_master');
            $table->string('alloted_by')->nullable();
            $table->timestamp('leema_datetime')->nullable()->useCurrent();
            $table->timestamp('leema_updatedatetime')->useCurrentOnUpdate()->nullable();
            $table->string('leema_ip', 120)->nullable();

            $table->unique(['leem_id', 'am_id'], 'leem_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_lead_event_exhibitor_mapping_activity');
    }
}
