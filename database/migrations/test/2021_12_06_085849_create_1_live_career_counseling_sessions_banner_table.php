<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1LiveCareerCounselingSessionsBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_live_career_counseling_sessions_banner', function (Blueprint $table) {
            $table->integer('lccsb_id', true);
            $table->enum('lccsd_type', ['eminent', 'career'])->nullable();
            $table->integer('aem_id')->nullable();
            $table->string('lccsb_name')->nullable();
            $table->enum('lccsb_status', ['active', 'inactive'])->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_live_career_counseling_sessions_banner');
    }
}
