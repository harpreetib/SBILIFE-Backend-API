<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1ExhibitorBoothStandyWallDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_exhibitor_booth_standy_wall_data', function (Blueprint $table) {
            $table->integer('ebswd_id', true);
            $table->integer('exhim_id')->nullable()->index('exhim_id');
            $table->enum('ebswd_type', ['standy', 'wall'])->nullable();
            $table->string('ebswd_class', 50)->nullable()->index('ebswd_class');
            $table->string('ebswd_image', 50)->nullable();
            $table->enum('ebswd_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_exhibitor_booth_standy_wall_data');
    }
}
