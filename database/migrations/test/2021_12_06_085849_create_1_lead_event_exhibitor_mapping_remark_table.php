<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1LeadEventExhibitorMappingRemarkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_lead_event_exhibitor_mapping_remark', function (Blueprint $table) {
            $table->integer('leer_id', true);
            $table->integer('leem_id')->nullable()->comment('from 1_lead_event_exhibitor_mapping');
            $table->text('leer_remark')->nullable()->comment('from lead_categorization');
            $table->integer('lc_id')->nullable();
            $table->integer('leer_updateby')->nullable();
            $table->string('leer_updateby_ip', 120)->nullable();
            $table->timestamp('leem_insert_date')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_lead_event_exhibitor_mapping_remark');
    }
}
