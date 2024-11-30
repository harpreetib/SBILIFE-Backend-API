<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1ManagWebinarStreamingRestrictListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_manag_webinar_streaming_restrict_list', function (Blueprint $table) {
            $table->integer('mwsrl_id', true);
            $table->integer('mwsr_id')->nullable();
            $table->string('mwsrl_name', 200)->nullable();
            $table->string('mwsrl_email', 200)->nullable();
            $table->string('mwsrl_country_code', 30)->nullable();
            $table->string('mwsrl_mobile', 50)->nullable();
            $table->enum('mwsrl_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_manag_webinar_streaming_restrict_list');
    }
}
