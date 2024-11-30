<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1WebinarStreamingRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_webinar_streaming_rating', function (Blueprint $table) {
            $table->integer('wsr_id', true);
            $table->integer('mws_id')->nullable();
            $table->integer('lemm_id')->nullable();
            $table->string('wsr_rating', 100)->nullable();
            $table->date('wsr_date')->nullable();
            $table->timestamp('wsr_insertdatetime')->nullable()->useCurrent();
            $table->string('wsr_ip', 120)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_webinar_streaming_rating');
    }
}
