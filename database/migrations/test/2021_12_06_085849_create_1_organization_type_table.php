<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1OrganizationTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_organization_type', function (Blueprint $table) {
            $table->integer('ot_id', true);
            $table->string('ot_name')->nullable();
            $table->integer('ot_orderby')->nullable();
            $table->enum('ot_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_organization_type');
    }
}
