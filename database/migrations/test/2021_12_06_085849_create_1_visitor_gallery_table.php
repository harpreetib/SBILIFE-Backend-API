<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1VisitorGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_visitor_gallery', function (Blueprint $table) {
            $table->integer('vg_id', true);
            $table->integer('lemm_id')->nullable()->comment('from lead_event_master_mapping');
            $table->enum('vg_type', ['image', 'video', 'poster', 'pdf'])->nullable()->default('poster');
            $table->enum('vg_category', ['PG', 'UG', 'Radiologist', 'Radiographer', 'Post Graduates'])->nullable()->default('PG');
            $table->string('vg_subcategory', 150)->nullable()->default('Sample');
            $table->string('vg_name')->nullable();
            $table->string('vg_unique_id', 50)->nullable();
            $table->string('pre_title')->nullable();
            $table->string('pre_fullname')->nullable();
            $table->string('pre_email', 150)->nullable();
            $table->string('pre_designation', 200)->nullable();
            $table->string('pre_college', 200)->nullable();
            $table->string('pre_ submission_ received_status', 120)->nullable();
            $table->string('vg_pdf')->nullable();
            $table->enum('vg_is_winner', ['Y', 'N'])->nullable()->default('N');
            $table->integer('vg_orderby')->nullable()->default(9999);
            $table->enum('vg_status', ['active', 'inactive'])->nullable()->default('active');
            $table->string('winner_rank')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_visitor_gallery');
    }
}
