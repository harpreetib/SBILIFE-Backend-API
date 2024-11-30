<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1ParticipationPlansSubscriptionMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_participation_plans_subscription_mapping', function (Blueprint $table) {
            $table->integer('ppsm_id', true);
            $table->integer('ppm')->nullable()->comment('from participation_plans_master');
            $table->integer('pps_id')->nullable()->comment('from participation_plans_subscription');
            $table->integer('ppsm_count')->nullable();
            $table->enum('ppsm_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_participation_plans_subscription_mapping');
    }
}
