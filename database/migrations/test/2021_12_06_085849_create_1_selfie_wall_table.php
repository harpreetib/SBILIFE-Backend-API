<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1SelfieWallTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_selfie_wall', function (Blueprint $table) {
            $table->integer('sw_id', true);
            $table->integer('lemm_id')->nullable();
            $table->string('sw_name')->nullable()->comment('/apps/public/vf/images/selfie-pics/');
            $table->string('sw_mixed_image', 200)->nullable()->comment('/apps/public/vf/images/selfie-pics/');
            $table->enum('sw_status', ['active', 'inactive'])->nullable()->default('active');
            $table->timestamp('sw_datetime')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_selfie_wall');
    }
}
