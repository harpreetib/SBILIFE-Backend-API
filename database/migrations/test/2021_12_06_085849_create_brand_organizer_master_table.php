<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandOrganizerMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_organizer_master', function (Blueprint $table) {
            $table->integer('bm_id', true);
            $table->string('bm_name')->nullable()->unique('bm_name');
            $table->string('bm_nickname', 120)->nullable()->unique('bm_nickname')->comment('without space');
            $table->string('bm_unique_field', 120)->nullable()->comment('take from lead_master');
            $table->string('bm_logo')->nullable();
            $table->string('bm_banner')->nullable();
            $table->enum('bm_theme', ['lite-red.min.css', 'lite-purple.min.css', 'dark-purple.min.css', 'lite-blue.min.css'])->default('lite-purple.min.css');
            $table->enum('bm_status', ['active', 'inactive'])->nullable()->default('active');
            $table->timestamp('bm_create_datetime')->useCurrent();
            $table->date('bm_closed_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brand_organizer_master');
    }
}
