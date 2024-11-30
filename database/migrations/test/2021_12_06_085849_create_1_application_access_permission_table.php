<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1ApplicationAccessPermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_application_access_permission', function (Blueprint $table) {
            $table->integer('aap_id', true);
            $table->integer('aem_id')->nullable()->comment('from event_master');
            $table->string('aap_name', 200)->nullable();
            $table->string('aap_mobile', 30)->nullable();
            $table->string('aap_email', 200)->nullable();
            $table->enum('aap_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_application_access_permission');
    }
}
