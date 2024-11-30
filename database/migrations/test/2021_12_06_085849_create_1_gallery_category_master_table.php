<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1GalleryCategoryMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_gallery_category_master', function (Blueprint $table) {
            $table->integer('gcm_id', true);
            $table->string('gcm_name', 150)->nullable();
            $table->integer('gcm_orderby')->nullable();
            $table->enum('gcm_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_gallery_category_master');
    }
}
