<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_data', function (Blueprint $table) {
            $table->id();
            $table->string('cd_full_name');
            $table->string('cd_email');
            $table->string('cd_phone');
            $table->string('cd_company_name');
            $table->string('cd_event_name');
            $table->string('cd_event_date');
            $table->enum('cd_event_type', ['Virtual', 'Hybrid'])->default('Virtual');
            $table->softDeletes(); // <-- This will add a deleted_at field
            $table->timestamps();
            $table->string('cd_ipAddress', 120)->nullable();
            $table->string('user_agent')->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_data');
    }
}
