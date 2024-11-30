<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1RedeemedHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_redeemed_history', function (Blueprint $table) {
            $table->integer('rh_id', true);
            $table->integer('rpm_id')->nullable()->comment('from redemption_point_master');
            $table->integer('rpcm_id')->nullable()->comment('from 1_redemption_point_coupon_mapping');
            $table->integer('lemm_id')->nullable()->comment('from lead_event_master_mapping');
            $table->dateTime('rh_datetime')->nullable()->useCurrent();
            $table->string('rh_ip', 120)->nullable();
            $table->enum('rh_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_redeemed_history');
    }
}
