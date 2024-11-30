<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1ExhibitorEventWithBoothstaffMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_exhibitor_event_with_boothstaff_mapping', function (Blueprint $table) {
            $table->integer('eewbm_id', true);
            $table->integer('eem_id')->nullable()->comment('from exhibitor_event_mapping');
            $table->integer('ebsm_id')->nullable()->comment('from exhibitor_boothstaff');
            $table->integer('pps_id')->nullable()->comment('from participation_plans_subscription');
            $table->string('eewbm_video_chat_name')->nullable();
            $table->enum('eewbm_video_chat_type', ['with_subscription', 'without_subscription'])->nullable()->default('with_subscription');
            $table->enum('eewbm_priority_in_list', ['Y', 'N'])->nullable()->default('N');
            $table->string('eewbm_video_caller_id_moderator')->nullable();
            $table->string('eewbm_video_caller_id')->nullable();
            $table->string('eewbm_video_url')->nullable();
            $table->string('eewbm_ppin')->nullable();
            $table->string('eewbm_mpin')->nullable();
            $table->string('eewbm_whatsapp_id', 50)->nullable();
            $table->string('eewbm_counseling_topics', 200)->nullable()->default('Counsellor');
            $table->enum('eewbm_status', ['active', 'inactive'])->nullable()->default('active');

            $table->unique(['eem_id', 'ebsm_id'], 'eem_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_exhibitor_event_with_boothstaff_mapping');
    }
}
