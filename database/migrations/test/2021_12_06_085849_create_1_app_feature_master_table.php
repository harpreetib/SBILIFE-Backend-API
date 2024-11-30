<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1AppFeatureMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_app_feature_master', function (Blueprint $table) {
            $table->integer('afm_id', true);
            $table->string('afm_name', 120)->nullable();
            $table->string('afm_internal_used_name', 120)->nullable()->comment('don\'t change');
            $table->text('afm_dependent_code')->nullable();
            $table->text('afm_icon_html')->nullable();
            $table->enum('afm_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_app_feature_master');
    }
}
