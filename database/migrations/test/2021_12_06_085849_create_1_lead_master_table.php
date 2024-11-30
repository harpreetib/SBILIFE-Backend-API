<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1LeadMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_lead_master', function (Blueprint $table) {
            $table->integer('lm_id', true);
            $table->enum('lm_is_test_lead', ['N', 'Y'])->nullable()->default('N');
            $table->string('title')->nullable();
            $table->string('lm_fullname')->nullable();
            $table->string('lm_firstname', 200)->nullable();
            $table->string('lm_lastname', 200)->nullable();
            $table->longText('lm_topic')->nullable();
            $table->string('lm_certificate_category')->nullable();
            $table->string('lm_fathername')->nullable();
            $table->string('lm_gender')->nullable();
            $table->date('lm_dob')->nullable();
            $table->date('lm_registrationdate')->nullable();
            $table->date('lm_admissiondate')->nullable();
            $table->string('lm_currentschool')->nullable();
            $table->string('lm_phone', 30)->nullable();
            $table->string('lm_country_code', 30)->nullable();
            $table->string('lm_mobile', 30)->nullable();
            $table->string('lm_otp', 12)->nullable();
            $table->enum('lm_is_verified', ['Y', 'N'])->default('N');
            $table->string('lm_alternate_phone', 125)->nullable();
            $table->string('lm_email', 120)->nullable();
            $table->text('lm_address1')->nullable();
            $table->text('lm_address2')->nullable();
            $table->string('city_id')->nullable()->comment('from master_city');
            $table->string('state_id')->nullable()->comment('from master_state');
            $table->string('country_id')->nullable()->comment('from master_country');
            $table->integer('lm_zip_code')->nullable();
            $table->string('lm_company_name')->nullable();
            $table->string('lm_designation')->nullable();
            $table->string('lm_department')->nullable();
            $table->string('lm_institute')->nullable();
            $table->string('lm_employee_id', 120)->nullable();
            $table->string('lm_mailing_preferences', 120)->nullable();
            $table->integer('lm_lead_origin')->nullable();
            $table->integer('lm_lead_source')->nullable();
            $table->text('lm_notes')->nullable();
            $table->string('lm_best_time_to_call', 120)->nullable();
            $table->integer('lm_lead_owner')->nullable()->comment('from login_master');
            $table->string('usertype')->nullable();
            $table->string('comment')->nullable();
            $table->string('nominationcat', 500)->nullable();
            $table->string('declaration')->nullable();
            $table->dateTime('lm_create_date')->nullable()->useCurrent();
            $table->dateTime('lm_last_update_date')->nullable();
            $table->enum('lm_statue', ['active', 'inactive'])->nullable()->default('active');
            $table->string('lm_unit')->nullable();
            $table->string('lm_incharge')->nullable();
            $table->enum('is_poster_access', ['Y', 'N'])->default('N');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_lead_master');
    }
}
