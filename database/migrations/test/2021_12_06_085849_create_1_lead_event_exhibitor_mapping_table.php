<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1LeadEventExhibitorMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_lead_event_exhibitor_mapping', function (Blueprint $table) {
            $table->integer('leem_id', true);
            $table->integer('lemm_id')->nullable()->index('lemm_id_2')->comment('from lead_event_master_mapping');
            $table->integer('exhim_id')->nullable()->index('exhim_id')->comment('from exhibitor_master');
            $table->integer('lc_id')->nullable()->default(4)->comment('from lead_categorization');
            $table->text('leem_comment')->nullable();
            $table->enum('leem_nopaper_sync', ['Y', 'N'])->default('N');
            $table->enum('leem_notify_toexhi', ['N', 'Y'])->nullable()->default('N');
            $table->integer('leem_updateby')->nullable();
            $table->string('leem_updateby_ip', 120)->nullable();
            $table->dateTime('leem_last_remark_update_date')->nullable();
            $table->timestamp('leem_datetime')->nullable()->useCurrent();

            $table->unique(['lemm_id', 'exhim_id'], 'lemm_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_lead_event_exhibitor_mapping');
    }
}
