<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1ExhibitorThumbnailDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_exhibitor_thumbnail_data', function (Blueprint $table) {
            $table->integer('etd_id', true);
            $table->integer('exhim_id');
            $table->string('etd_caption');
            $table->string('etd_image');
            $table->string('etd_link')->nullable();
            $table->enum('etd_status', ['Y', 'N'])->default('Y');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_exhibitor_thumbnail_data');
    }
}
