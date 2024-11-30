<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1ParticipationPlansMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_participation_plans_master', function (Blueprint $table) {
            $table->integer('ppm_id', true);
            $table->string('ppm_text')->nullable();
            $table->integer('ppm_counsellor_count');
            $table->integer('ppm_orderby')->nullable()->comment('Priority Search Listing');
            $table->enum('ppm_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_participation_plans_master');
    }
}
