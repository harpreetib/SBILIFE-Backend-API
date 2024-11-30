<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1RedemptionPointMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_redemption_point_master', function (Blueprint $table) {
            $table->integer('rpm_id', true);
            $table->integer('rpm_points');
            $table->string('rpm_text');
            $table->text('rpm_description')->nullable();
            $table->string('rpm_image')->nullable();
            $table->string('rpm_mail_template')->nullable();
            $table->enum('rpm_status', ['active', 'inactive'])->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_redemption_point_master');
    }
}
