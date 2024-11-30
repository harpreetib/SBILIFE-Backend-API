<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1InquiryDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_inquiry_data', function (Blueprint $table) {
            $table->integer('ind_id', true);
            $table->integer('aem_id')->nullable()->comment('from event_master');
            $table->integer('lemm_id')->nullable()->comment('from lead_event_master_mapping');
            $table->integer('exhim_id')->nullable()->comment('from exhibitor_master');
            $table->integer('epm_id')->nullable();
            $table->string('ind_fullname')->nullable();
            $table->string('ind_email')->nullable();
            $table->string('ind_mobile', 50)->nullable();
            $table->text('ind_message')->nullable();
            $table->string('ind_ip', 120)->nullable();
            $table->timestamp('ind_entry_date')->nullable()->useCurrent();
            $table->timestamp('ind_last_update_date')->useCurrentOnUpdate()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_inquiry_data');
    }
}
