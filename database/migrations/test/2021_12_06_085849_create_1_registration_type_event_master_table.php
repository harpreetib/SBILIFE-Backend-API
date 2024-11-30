<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1RegistrationTypeEventMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_registration_type_event_master', function (Blueprint $table) {
            $table->integer('rtem_id', true);
            $table->integer('rtm_id')->nullable()->comment('from registration_type_master');
            $table->integer('aem_id')->nullable();
            $table->string('rtem_display_text')->nullable();
            $table->string('rtem_amont')->nullable();
            $table->enum('rtem_is_action', ['N', 'Y'])->nullable()->default('N');
            $table->integer('rtem_orderby')->nullable();
            $table->enum('rtem_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_registration_type_event_master');
    }
}
