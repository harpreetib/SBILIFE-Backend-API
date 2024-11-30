<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_mappings', function (Blueprint $table) {
            $table->integer('sm_id', true);
            $table->integer('aem_id')->nullable();
            $table->integer('afm_id')->nullable()->comment('from app_feature_master');
            $table->integer('cm_id')->nullable()->comment('from customer_data');
            $table->enum('sm_status', ['active', 'inactive'])->nullable()->default('active');
           $table->softDeletes(); // <-- This will add a deleted_at field
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_mappings');
    }
}
