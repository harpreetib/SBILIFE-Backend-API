<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_mappings', function (Blueprint $table) {
            $table->integer('map_id', true);
            $table->integer('bm_id')->nullable()->index('bm_id')->comment('from brand_master');
            $table->string('user_name')->unique('user_name');
            $table->string('login_id', 50)->nullable();
            $table->string('password', 40)->nullable();
            $table->string('email_id')->nullable();
            $table->string('mobile_no', 20)->nullable();
            $table->string('images')->nullable();
            $table->integer('at_id')->index('at_id');
            $table->enum('status', ['active', 'inactive'])->nullable()->default('active');
            $table->enum('login_status', ['loggedin', 'loggedout'])->nullable()->default('loggedout');
            $table->timestamp('loggedin_datetime')->nullable();
            $table->timestamp('create_datetime')->useCurrent();
            $table->boolean('first_flag')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('access_mappings');
    }
}
