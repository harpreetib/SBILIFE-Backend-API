<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1ScribbleWallTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_scribble_wall', function (Blueprint $table) {
            $table->integer('sw_id', true);
            $table->integer('lemm_id');
            $table->text('sw_text');
            $table->timestamp('sw_datetime')->useCurrent();
            $table->enum('sw_status', ['active', 'inactive'])->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_scribble_wall');
    }
}
