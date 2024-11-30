<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1LeadEventActivityMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_lead_event_activity_mapping', function (Blueprint $table) {
            $table->integer('leam_id', true);
            $table->integer('lemm_id')->comment('lemm_id logged in visitor');
            $table->integer('lemm_visitor_id')->nullable()->comment('lemm_id clicked visitor');
            $table->integer('am_id');
            $table->integer('aem_id')->nullable();
            $table->timestamp('leam_datetime')->nullable()->useCurrent();
            $table->string('leam_ip', 120)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_lead_event_activity_mapping');
    }
}
