<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1ManagWebinarStreamingRestrictTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_manag_webinar_streaming_restrict', function (Blueprint $table) {
            $table->integer('mwsr_id', true);
            $table->integer('mws_id')->nullable();
            $table->dateTime('mwsr_startdatetime')->nullable();
            $table->dateTime('mwsr_enddatetime')->nullable();
            $table->text('mwsr_jsondata')->nullable();
            $table->enum('mwsr_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_manag_webinar_streaming_restrict');
    }
}
