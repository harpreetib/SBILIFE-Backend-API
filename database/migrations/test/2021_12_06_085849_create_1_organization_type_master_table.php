<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1OrganizationTypeMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_organization_type_master', function (Blueprint $table) {
            $table->integer('otm_id', true);
            $table->string('otm_name')->nullable();
            $table->integer('otm_orderby')->nullable();
            $table->enum('otm_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_organization_type_master');
    }
}
