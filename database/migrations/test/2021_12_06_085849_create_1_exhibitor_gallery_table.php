<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1ExhibitorGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_exhibitor_gallery', function (Blueprint $table) {
            $table->integer('eg_id', true);
            $table->integer('exhim_id')->nullable()->comment('from exhibitor_master');
            $table->enum('eg_type', ['image', 'video'])->nullable()->default('image');
            $table->string('eg_video_type')->nullable();
            $table->string('eg_name')->nullable();
            $table->string('eg_caption', 150)->nullable();
            $table->integer('gcm_id')->nullable()->comment('from gallery_category_master');
            $table->integer('eg_orderby')->nullable();
            $table->enum('eg_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_exhibitor_gallery');
    }
}
