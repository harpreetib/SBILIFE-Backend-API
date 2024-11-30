<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1SessionAgendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_session_agenda', function (Blueprint $table) {
            $table->integer('sa_id', true);
            $table->integer('lccs_id');
            $table->string('sa_time')->nullable();
            $table->string('sa_title')->nullable();
            $table->longText('sa_desc')->nullable();
            $table->enum('sa_status', ['active', 'inactive'])->default('inactive');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_session_agenda');
    }
}
