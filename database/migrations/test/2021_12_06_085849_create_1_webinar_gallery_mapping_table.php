<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1WebinarGalleryMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_webinar_gallery_mapping', function (Blueprint $table) {
            $table->integer('wgm_id', true);
            $table->integer('mws_id');
            $table->string('wgm_video_caption')->nullable();
            $table->string('wgm_video_url');
            $table->enum('wgm_status', ['Y', 'N'])->default('Y');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_webinar_gallery_mapping');
    }
}
