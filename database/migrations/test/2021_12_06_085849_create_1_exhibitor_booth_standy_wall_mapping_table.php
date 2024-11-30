<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1ExhibitorBoothStandyWallMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_exhibitor_booth_standy_wall_mapping', function (Blueprint $table) {
            $table->integer('ebswm_id', true);
            $table->integer('ebm_id');
            $table->enum('ebswm_type', ['standy', 'wall'])->nullable();
            $table->string('ebswm_width', 50);
            $table->string('ebswm_height', 50);
            $table->string('ebswm_class', 50)->nullable();
            $table->enum('ebswm_status', ['active', 'inactive'])->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_exhibitor_booth_standy_wall_mapping');
    }
}
