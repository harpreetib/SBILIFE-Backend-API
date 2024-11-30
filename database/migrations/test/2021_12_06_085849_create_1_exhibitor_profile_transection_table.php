<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1ExhibitorProfileTransectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_exhibitor_profile_transection', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('exid')->unique('exid');
            $table->tinyInteger('booth_design')->default(2);
            $table->tinyInteger('booth_setup_logo')->default(2);
            $table->tinyInteger('booth_setup_standy_logo')->default(2);
            $table->tinyInteger('booth_setup_desc_logo')->default(2);
            $table->tinyInteger('booth_setup_back_drop')->default(2);
            $table->tinyInteger('booth_setup_lobby_image')->default(2);
            $table->tinyInteger('booth_setup_lobby_about')->default(2);
            $table->tinyInteger('booth_photogallery')->default(2);
            $table->tinyInteger('booth_videogallery')->default(2);
            $table->tinyInteger('booth_brouchere')->default(2);
            $table->tinyInteger('manage_boothstaff')->default(2);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_exhibitor_profile_transection');
    }
}
