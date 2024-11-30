<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1BriefcaseDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_briefcase_data', function (Blueprint $table) {
            $table->integer('bd_id', true);
            $table->integer('lemm_id')->nullable();
            $table->integer('exhim_id')->nullable();
            $table->integer('epm_id')->nullable();
            $table->enum('status', ['Y', 'N'])->default('Y');
            $table->timestamp('insert_date')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_briefcase_data');
    }
}
