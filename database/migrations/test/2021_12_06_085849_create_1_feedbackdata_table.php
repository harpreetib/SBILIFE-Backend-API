<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1FeedbackdataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_feedbackdata', function (Blueprint $table) {
            $table->integer('fd_id', true);
            $table->integer('lemm_id');
            $table->string('coverage')->nullable();
            $table->string('quality')->nullable();
            $table->string('structure')->nullable();
            $table->string('clarity')->nullable();
            $table->string('efficacy')->nullable();
            $table->string('platform')->nullable();
            $table->string('knowledge')->nullable();
            $table->string('overallrating')->nullable();
            $table->longText('topicshear')->nullable();
            $table->longText('suggestion')->nullable();
            $table->string('percentage')->nullable();
            $table->string('sessioninfo')->nullable();
            $table->string('participateworkshop')->nullable();
            $table->string('virtual_plat')->nullable();
            $table->string('workshopoverallrating')->nullable();
            $table->string('recommendini')->nullable();
            $table->timestamp('insert_datetime')->useCurrent();
            $table->timestamp('updatetime')->useCurrentOnUpdate()->nullable();
            $table->string('fedback_ip', 120)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_feedbackdata');
    }
}
