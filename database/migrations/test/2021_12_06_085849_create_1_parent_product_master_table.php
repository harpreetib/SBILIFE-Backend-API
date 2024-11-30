<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1ParentProductMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_parent_product_master', function (Blueprint $table) {
            $table->integer('ppm_id', true);
            $table->string('ppm_text', 225)->nullable()->unique('ppm_text');
            $table->string('ppm_text_use_landbot')->nullable();
            $table->string('ppm_product_eg')->nullable();
            $table->integer('ppm_orderby')->nullable();
            $table->enum('ppm_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_parent_product_master');
    }
}
