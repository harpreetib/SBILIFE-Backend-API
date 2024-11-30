<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1ExhibitorBoothdesignMasterBackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_exhibitor_boothdesign_master_back', function (Blueprint $table) {
            $table->integer('ebm_id', true);
            $table->integer('ppm_id')->nullable()->comment('from participation_plans_master');
            $table->string('ebm_image')->nullable();
            $table->string('ebm_image_frontend');
            $table->string('ebm_css')->nullable();
            $table->enum('ebm_logo', ['Y', 'N'])->nullable()->default('N');
            $table->enum('ebm_standee', ['Y', 'N'])->default('N');
            $table->string('ebm_backdrop_width')->nullable();
            $table->string('ebm_backdrop_height')->nullable();
            $table->enum('ebm_banner', ['Y', 'N'])->default('N');
            $table->enum('ebm_status', ['Y', 'N'])->default('Y');
            $table->string('ebm_banner_width', 120)->nullable();
            $table->string('ebm_banner_height', 120)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_exhibitor_boothdesign_master_back');
    }
}
