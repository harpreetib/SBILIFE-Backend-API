<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1ManageIntermediatePageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_manage_intermediate_page', function (Blueprint $table) {
            $table->integer('mip_id', true);
            $table->integer('aem_id')->nullable();
            $table->string('mip_name', 120)->nullable();
            $table->string('mip_caption')->nullable();
            $table->string('mip_bgimage', 120)->nullable();
            $table->longText('mip_presentation_video')->nullable();
            $table->longText('mip_lobby_video')->nullable();
            $table->longText('mip_redirect_url')->nullable();
            $table->text('mip_html')->nullable();
            $table->longText('mip_footer_wigets')->nullable();
            $table->longText('mip_custom_css')->nullable();
            $table->text('mip_menu_html')->nullable();
            $table->enum('mip_is_menu_show_presentation_page', ['N', 'Y'])->default('N');
            $table->text('mip_css_script')->nullable();
            $table->integer('gcm_id')->nullable()->comment('from gallery_category_master');
            $table->integer('mip_order')->nullable();
            $table->enum('mip_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_manage_intermediate_page');
    }
}
