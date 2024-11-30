<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1MasterVideoDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_master_video_data', function (Blueprint $table) {
            $table->integer('mvd_iid', true);
            $table->string('obj_id')->nullable();
            $table->string('moderator_name')->nullable();
            $table->string('room_type')->nullable();
            $table->string('room_id')->nullable();
            $table->string('mpin')->nullable();
            $table->string('ppin')->nullable();
            $table->string('email')->nullable();
            $table->string('login_url_moderator')->nullable();
            $table->string('login_url_attendee')->nullable();
            $table->string('status', 21)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_master_video_data');
    }
}
