<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1LeadEventMasterMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_lead_event_master_mapping', function (Blueprint $table) {
            $table->integer('lemm_id', true);
            $table->integer('aem_id')->nullable()->comment('from event_master');
            $table->integer('lm_id')->nullable()->comment('from lead_master');
            $table->bigInteger('lemm_hitcount')->default(0);
            $table->integer('rtem_id')->nullable()->default(1)->comment('registration_type_event_master');
            $table->integer('ot_id')->nullable()->comment('describes your company from organization_type');
            $table->integer('otm_id')->nullable()->comment('like to meet from organization_type_master');
            $table->string('ppm_id')->nullable();
            $table->integer('qm_id')->nullable();
            $table->string('ls_id', 120)->nullable()->default('20')->comment('from master_lead_source');
            $table->string('lemm_adid', 120)->nullable()->comment('Marketing medium: (e.g. cpc, banner, email)');
            $table->string('lemm_utm_campaign')->nullable()->comment('Product, promo code, or slogan (e.g. spring_sale)');
            $table->string('lemm_utm_term')->nullable()->comment('Identify the paid keywords');
            $table->string('lemm_utm_content')->nullable()->comment('Use to differentiate ads');
            $table->string('lemm_tnc', 200)->nullable();
            $table->enum('lemm_reg_type', ['pre-reg', 'during-event'])->nullable()->default('pre-reg');
            $table->enum('lemm_whatsapp_opt_out', ['Y', 'N'])->default('N');
            $table->enum('mail_sent', ['Y', 'N'])->default('N');
            $table->enum('whatsapp_sent', ['Y', 'N'])->default('N');
            $table->enum('sms_sent', ['Y', 'N'])->default('N');
            $table->enum('lemm_login_status', ['loggedin', 'loggedout'])->nullable();
            $table->enum('lemm_online_status', ['online', 'offline'])->nullable();
            $table->longText('lemm_useragent')->nullable();
            $table->string('lemm_meeting_id')->nullable();
            $table->string('lemm_meeting_url')->nullable();
            $table->string('lemm_meeting_room_name')->nullable();
            $table->string('lemm_allotted_rooms')->nullable();
            $table->enum('lemm_is_show_networkinglounge', ['Y', 'N'])->nullable()->default('Y');
            $table->timestamp('lemm_insert_date')->nullable()->useCurrent();
            $table->dateTime('lemm_update_date')->nullable();
            $table->string('lemm_ip', 120)->nullable();
            $table->enum('lemm_status', ['active', 'inactive'])->nullable()->default('active');

            $table->unique(['aem_id', 'lm_id'], 'aem_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_lead_event_master_mapping');
    }
}
