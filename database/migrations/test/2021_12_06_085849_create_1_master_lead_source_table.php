<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1MasterLeadSourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_master_lead_source', function (Blueprint $table) {
            $table->integer('ls_id', true);
            $table->string('ls_text')->nullable();
            $table->integer('ls_orderby')->nullable();
            $table->enum('ls_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_master_lead_source');
    }
}
