<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1LiveCareerCounselingSessionsSpeakerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_live_career_counseling_sessions_speaker', function (Blueprint $table) {
            $table->integer('lccss_id', true);
            $table->integer('lccs_id')->nullable();
            $table->string('lccss_name')->nullable();
            $table->string('lccss_designation')->nullable();
            $table->text('lccss_description')->nullable();
            $table->string('lccss_pic')->nullable();
            $table->enum('lccss_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_live_career_counseling_sessions_speaker');
    }
}
