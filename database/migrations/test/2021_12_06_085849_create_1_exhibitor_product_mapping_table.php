<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1ExhibitorProductMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_exhibitor_product_mapping', function (Blueprint $table) {
            $table->integer('epm_id', true);
            $table->integer('exhim_id')->nullable();
            $table->string('qm_id', 120)->nullable()->comment('from qualification_master');
            $table->integer('exhipm_id')->nullable()->comment('from exhibitor_product_master');
            $table->text('epm_eligibility')->nullable();
            $table->string('epm_duration_in_year', 120)->nullable();
            $table->string('epm_category')->nullable();
            $table->string('epm_fee_charged_per_sem', 30)->nullable();
            $table->string('epm_total_fee_charged', 120)->nullable();
            $table->string('epm_course_fee_text', 120)->nullable();
            $table->string('e_com')->nullable();
            $table->string('product_image')->nullable();
            $table->string('epm_brochure')->nullable();
            $table->enum('epm_scholarship_program', ['yes', 'no'])->nullable()->default('no');
            $table->text('epm_scope')->nullable();
            $table->text('epm_industry_sponsored_labs')->nullable();
            $table->text('epm_careers')->nullable();
            $table->text('epm_top_recruiters')->nullable();
            $table->text('epm_additional_details')->nullable()->comment('like Highest package');
            $table->integer('epm_orderby')->nullable();
            $table->enum('epm_status', ['active', 'inactive'])->nullable()->default('active');

            $table->index(['exhim_id', 'exhipm_id'], 'exhim_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_exhibitor_product_mapping');
    }
}
