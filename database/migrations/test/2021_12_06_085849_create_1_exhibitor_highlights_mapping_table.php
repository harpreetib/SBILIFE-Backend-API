<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1ExhibitorHighlightsMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_exhibitor_highlights_mapping', function (Blueprint $table) {
            $table->integer('ehm_id', true);
            $table->integer('exhim_id')->comment('from 1_exhibitor_master');
            $table->text('ehm_highlight_text')->nullable();
            $table->enum('ehm_status', ['active', 'inactive'])->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_exhibitor_highlights_mapping');
    }
}
