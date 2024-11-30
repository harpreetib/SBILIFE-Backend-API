<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1RegistrationTypeMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_registration_type_master', function (Blueprint $table) {
            $table->integer('rtm_id', true);
            $table->string('rtm_name')->nullable();
            $table->integer('rtm_orderby')->nullable();
            $table->enum('rtm_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_registration_type_master');
    }
}
