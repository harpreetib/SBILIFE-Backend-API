<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1ExhiAddonServiceMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_exhi_addon_service_mapping', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('exhim_id');
            $table->integer('aem_id');
            $table->integer('pps_id');
            $table->integer('count');
            $table->timestamp('insert_datetime')->useCurrent();
            $table->timestamp('update_datetime')->useCurrentOnUpdate()->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_exhi_addon_service_mapping');
    }
}
