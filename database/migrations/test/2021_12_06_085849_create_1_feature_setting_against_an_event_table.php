<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1FeatureSettingAgainstAnEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_feature_setting_against_an_event', function (Blueprint $table) {
            $table->integer('fsae_id', true);
            $table->integer('aem_id')->nullable();
            $table->integer('afm_id')->nullable()->comment('from app_feature_master');
            $table->integer('alm_id')->nullable()->comment('from app_landingpage_master');
            $table->integer('apcm_id')->nullable()->comment('from ad_pixel_code_master');
            $table->string('fsae_ad_code', 150)->nullable()->comment('ad source code');
            $table->string('fsae_ad_conversion_code', 150)->nullable();
            $table->text('fsae_dependent_code')->nullable();
            $table->enum('fsae_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_feature_setting_against_an_event');
    }
}
