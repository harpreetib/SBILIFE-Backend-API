<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1ExhibitorHallCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_exhibitor_hall_category', function (Blueprint $table) {
            $table->integer('ehc_id', true);
            $table->integer('aem_id')->nullable();
            $table->string('ehc_hall_name', 120)->nullable();
            $table->string('ehc_name')->nullable();
            $table->string('ehc_hall_bgimage', 120)->nullable();
            $table->string('ehc_hall_presentation_video')->nullable();
            $table->integer('gcm_id')->nullable()->comment('from gallery_category_master');
            $table->integer('ehc_order')->nullable()->default(9999);
            $table->enum('ehc_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_exhibitor_hall_category');
    }
}
