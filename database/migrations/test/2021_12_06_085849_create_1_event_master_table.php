<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1EventMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_event_master', function (Blueprint $table) {
            $table->integer('aem_id', true);
            $table->integer('parent_aem_id')->nullable();
            $table->integer('bm_id')->nullable();
            $table->string('aem_event_nickname', 120)->nullable()->unique('aem_event_nickname');
            $table->string('aem_name', 250)->nullable();
            $table->string('aem_short_name')->nullable();
            $table->string('aem_tag_line')->nullable();
            $table->string('aem_organized_by')->nullable();
            $table->string('aem_organizer_website')->nullable();
            $table->string('aem_full_address')->nullable();
            $table->string('aem_location', 250)->nullable();
            $table->dateTime('aem_start_date')->nullable();
            $table->dateTime('aem_end_date')->nullable();
            $table->dateTime('aem_relaxation_date')->nullable();
            $table->string('aem_date', 250)->nullable();
            $table->string('aem_event_date')->nullable();
            $table->string('aem_day', 200)->nullable();
            $table->string('aem_date_intext', 120)->nullable();
            $table->string('aem_time', 200)->nullable();
            $table->text('aem_timezones')->nullable();
            $table->text('aem_mail_html')->nullable();
            $table->text('aem_mail_subject')->nullable();
            $table->text('aem_otp_mail_html')->nullable();
            $table->text('aem_otp_mail_subject')->nullable();
            $table->text('aem_sms_text')->nullable();
            $table->integer('aem_sms_template')->nullable();
            $table->enum('aem_is_send_whatsapp', ['Y', 'N'])->nullable()->default('N');
            $table->string('aem_logo_image', 250)->nullable();
            $table->string('aem_header_img')->nullable();
            $table->integer('aem_orderby')->nullable();
            $table->enum('aem_status', ['future', 'current', 'old', 'inactivate'])->nullable()->default('future');
            $table->timestamp('aem_insert_time')->nullable()->useCurrent();
            $table->timestamp('aem_update_time')->useCurrentOnUpdate()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_event_master');
    }
}
