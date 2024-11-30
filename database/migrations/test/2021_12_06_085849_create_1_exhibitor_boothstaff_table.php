<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1ExhibitorBoothstaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_exhibitor_boothstaff', function (Blueprint $table) {
            $table->integer('ebsm_id', true);
            $table->integer('exhim_id')->nullable()->index('exhim_id')->comment('from exhibitor_master');
            $table->string('ebsm_name')->nullable();
            $table->string('ebsm_designation')->nullable();
            $table->string('ebsm_profile_pic')->nullable();
            $table->string('ebsm_country_code')->nullable();
            $table->string('ebsm_mobile', 120)->nullable();
            $table->string('ebm_login_user')->nullable()->unique('ebm_login_user');
            $table->string('ebm_login_pwd', 30)->nullable();
            $table->integer('at_id')->nullable()->default(4)->comment('from access_types');
            $table->enum('ebsm_livestatus', ['online', 'offline'])->nullable()->default('offline');
            $table->enum('ebsm_statu', ['active', 'inactive'])->nullable()->default('active');
            $table->dateTime('ebsm_insertdate')->nullable()->useCurrent();
            $table->timestamp('ebsm_updatedate')->useCurrentOnUpdate()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_exhibitor_boothstaff');
    }
}
