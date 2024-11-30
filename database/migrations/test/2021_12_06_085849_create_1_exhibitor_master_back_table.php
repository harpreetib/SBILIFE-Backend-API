<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1ExhibitorMasterBackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_exhibitor_master_back', function (Blueprint $table) {
            $table->integer('exhim_id', true);
            $table->string('exhim_organization_name');
            $table->string('exhim_custom_page')->nullable();
            $table->integer('ot_id')->nullable()->comment('from organization_type');
            $table->integer('ebm_id')->nullable()->comment('from exhibitor_boothdesign_master');
            $table->string('exhim_logo')->nullable();
            $table->string('exhim_banner')->nullable();
            $table->string('exhim_mo_v_banner', 150)->nullable();
            $table->string('exhim_standee')->nullable();
            $table->string('exhim_standee1')->nullable();
            $table->string('exhim_mo_standee')->nullable();
            $table->string('exhim_right_standee')->nullable();
            $table->string('exhim_right_standee_mo')->nullable();
            $table->string('exhim_stall_backdropofvideo', 150)->nullable();
            $table->string('exhim_stall_video')->nullable();
            $table->string('exhim_desk_logo', 150)->nullable();
            $table->string('exhim_lobby_image', 150)->nullable();
            $table->string('exhim_lobbyvideo')->nullable();
            $table->string('exhim_punchline')->nullable();
            $table->text('exhim_detail')->nullable();
            $table->string('section_head')->nullable();
            $table->text('exhim_fact_sheet_html')->nullable();
            $table->text('exhim_contact_us')->nullable();
            $table->string('counm_id')->nullable();
            $table->integer('sm_id')->nullable()->comment('from master_state');
            $table->integer('cm_id')->nullable()->comment('from master_city');
            $table->string('exhim_address')->nullable();
            $table->string('exhim_type_of_institute')->nullable();
            $table->string('exhim_ownership')->nullable();
            $table->string('exhim_estd_year', 50)->nullable();
            $table->string('exhim_accreditation', 50)->nullable();
            $table->string('exhim_recognition', 120)->nullable();
            $table->string('exhim_campus_area', 50)->nullable();
            $table->string('exhim_approval', 50)->nullable();
            $table->string('exhim_brochure')->nullable();
            $table->enum('exhim_qs_i_gauge', ['yes', 'no'])->nullable()->default('no');
            $table->string('exhim_qs_logo')->nullable();
            $table->enum('exhim_scholarship', ['Y', 'N'])->default('N');
            $table->string('exhim_scholarship_percentage')->nullable();
            $table->enum('exhim_NoPaperForms', ['yes', 'no'])->default('no');
            $table->string('exhim_np_secret_key')->nullable();
            $table->string('exhim_np_college_id')->nullable();
            $table->text('exhim_admission_details_html')->nullable();
            $table->string('exhim_facebook_link')->nullable();
            $table->text('exhim_web_link')->nullable();
            $table->string('exhim_youtube_link')->nullable();
            $table->string('exhim_instagram_link')->nullable();
            $table->string('exhim_twitter_link')->nullable();
            $table->string('exhim_whatsapp', 120)->nullable();
            $table->string('exhim_contact_person')->nullable();
            $table->string('exhim_contact_email')->nullable();
            $table->string('exhim_login_id')->nullable();
            $table->text('em_chatbot_script')->nullable();
            $table->timestamp('exhim_insert')->nullable()->useCurrent();
            $table->timestamp('exhim_update')->useCurrentOnUpdate()->nullable();
            $table->enum('exhim_status', ['active', 'inactive'])->nullable()->default('active');
            $table->enum('display', ['Yes', 'No'])->nullable()->default('Yes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_exhibitor_master_back');
    }
}