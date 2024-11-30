<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1QualificationMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_qualification_master', function (Blueprint $table) {
            $table->integer('qm_id', true);
            $table->string('qm_text')->nullable();
            $table->integer('qm_orderby')->nullable();
            $table->enum('qm_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_qualification_master');
    }
}
