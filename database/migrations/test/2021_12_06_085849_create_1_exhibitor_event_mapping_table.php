<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1ExhibitorEventMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_exhibitor_event_mapping', function (Blueprint $table) {
            $table->integer('eem_id', true);
            $table->integer('aem_id')->nullable()->comment('from event_master');
            $table->integer('exhim_id')->nullable()->comment('from exhibitor_master');
            $table->integer('ppm_id')->nullable()->default(3)->comment('from participation_plans_master');
            $table->integer('ehc_id')->nullable()->default(1)->comment('exhibitor_hall_category');
            $table->string('eem_custom_backtohall', 200)->nullable();
            $table->integer('eem_orderby')->nullable()->default(9999);
            $table->enum('eem_status', ['active', 'inactive'])->nullable()->default('active');

            $table->unique(['aem_id', 'exhim_id'], 'aem_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_exhibitor_event_mapping');
    }
}
