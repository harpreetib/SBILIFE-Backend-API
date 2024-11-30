<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1AppLandingpageMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_app_landingpage_master', function (Blueprint $table) {
            $table->integer('alm_id', true);
            $table->string('alm_name');
            $table->string('alm_page_name')->nullable();
            $table->enum('alm_status', ['active', 'inactive'])->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_app_landingpage_master');
    }
}
