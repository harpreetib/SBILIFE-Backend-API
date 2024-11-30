<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1BreakOutRoomsCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_break_out_rooms_category', function (Blueprint $table) {
            $table->integer('borc_id', true);
            $table->string('borc_name', 150)->nullable();
            $table->string('borc_room_url')->nullable();
            $table->string('borc_link_pointer_class', 120)->nullable();
            $table->integer('borc_orderby')->nullable();
            $table->enum('borc_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_break_out_rooms_category');
    }
}
