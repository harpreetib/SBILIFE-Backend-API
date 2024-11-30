<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1LiveCareerCounselingSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_live_career_counseling_sessions', function (Blueprint $table) {
            $table->integer('lccs_id', true);
            $table->integer('aem_id')->nullable()->comment('from event_master');
            $table->enum('lccs_type', ['live_eminent', 'live_career'])->nullable();
            $table->string('lccs_name')->nullable();
            $table->string('lccs_sub_title')->nullable();
            $table->text('lccs_speaker_name')->nullable();
            $table->string('lccs_moderator_pic')->nullable();
            $table->string('lccs_moderator_name')->nullable();
            $table->string('lccs_moderator_designation')->nullable();
            $table->string('lccs_moderator_desc')->nullable();
            $table->string('lccs_host_pic')->nullable();
            $table->string('lccs_host_name')->nullable();
            $table->string('lccs_host_designation')->nullable();
            $table->string('lccs_host_desc')->nullable();
            $table->dateTime('lccs_start_datewtime_for_showlive')->nullable();
            $table->dateTime('lccs_start_datewtime')->nullable();
            $table->dateTime('lccs_end_datewtime')->nullable();
            $table->string('lccs_zoom_id')->nullable();
            $table->string('lccs_zoom_pwd', 120)->nullable();
            $table->string('lcss_room_id');
            $table->string('lccs_past_session_video_url')->nullable();
            $table->integer('lccs_orderby')->nullable();
            $table->enum('lccs_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_live_career_counseling_sessions');
    }
}
