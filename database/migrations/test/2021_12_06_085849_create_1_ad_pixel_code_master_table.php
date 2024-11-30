<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1AdPixelCodeMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_ad_pixel_code_master', function (Blueprint $table) {
            $table->integer('apcm_id', true);
            $table->string('apcm_source', 150)->nullable();
            $table->text('apcm_pixel_code')->nullable();
            $table->string('apcm_pixel_code_dynamic_text', 20)->nullable();
            $table->text('apcm_pixel_conversion')->nullable();
            $table->string('apcm_pixel_conversion_dynamic_text', 20)->nullable();
            $table->enum('apcm_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_ad_pixel_code_master');
    }
}
