<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1LeadCategorizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_lead_categorization', function (Blueprint $table) {
            $table->integer('lc_id', true);
            $table->integer('lpc_id')->nullable()->default(3)->comment('from lead_parent_categorization');
            $table->string('lc_text')->nullable();
            $table->integer('lc_orderby')->nullable();
            $table->enum('lc_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_lead_categorization');
    }
}
