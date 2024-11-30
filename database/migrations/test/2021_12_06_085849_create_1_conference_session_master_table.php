<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1ConferenceSessionMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_conference_session_master', function (Blueprint $table) {
            $table->integer('csm_id', true);
            $table->integer('csm_day');
            $table->string('session_name')->nullable();
            $table->string('csm_start_time', 100)->nullable();
            $table->string('csm_end_time', 100);
            $table->enum('csm_status', ['active', 'inactive'])->default('inactive');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_conference_session_master');
    }
}
