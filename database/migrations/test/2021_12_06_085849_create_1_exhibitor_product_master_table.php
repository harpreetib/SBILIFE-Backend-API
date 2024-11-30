<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1ExhibitorProductMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_exhibitor_product_master', function (Blueprint $table) {
            $table->integer('exhipm_id', true);
            $table->integer('ppm_id')->nullable()->comment('from parent_product_master');
            $table->string('epm_text')->nullable()->comment('course/ product name');
            $table->integer('epm_orderby')->nullable();
            $table->enum('epm_status', ['active', 'inactive'])->nullable()->default('active');

            $table->unique(['epm_text', 'ppm_id'], 'epm_text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_exhibitor_product_master');
    }
}
