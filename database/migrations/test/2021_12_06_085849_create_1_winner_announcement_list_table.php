<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1WinnerAnnouncementListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_winner_announcement_list', function (Blueprint $table) {
            $table->integer('wal_id', true);
            $table->integer('lemm_id')->nullable()->unique('lemm_id');
            $table->enum('wal_prize_claim_status', ['N', 'Y'])->nullable()->default('N');
            $table->dateTime('wal_prize_claim_datetime')->nullable();
            $table->dateTime('wal_winner_announcement_datetime')->nullable()->useCurrent();
            $table->enum('wal_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_winner_announcement_list');
    }
}
