<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1ManagWebinarStreamingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('1_manag_webinar_streaming', function (Blueprint $table) {
            $table->integer('mws_id', true);
            $table->integer('aem_id')->nullable();
            $table->enum('mws_mode', ['live', 'gallery'])->default('live');
            $table->string('mws_has_exhibition')->default('Yes');
            $table->string('mws_exhibition_url')->nullable();
            $table->string('mws_name', 120)->nullable()->unique('mws_name');
            $table->string('mws_live_chat_url')->nullable();
            $table->string('mws_video_url')->nullable();
            $table->string('mws_youtube_url')->nullable();
            $table->string('mws_facebook_url')->nullable();
            $table->string('mws_webinar_finish_url')->nullable();
            $table->string('mws_background_img')->nullable();
            $table->string('mws_presentation_video')->nullable();
            $table->longText('mws_footer_wigets')->nullable();
            $table->longText('mws_custom_css')->nullable();
            $table->string('mws_left_banner')->nullable();
            $table->string('mws_right_banner')->nullable();
            $table->dateTime('mws_startdatetime')->nullable();
            $table->dateTime('mws_enddatetime')->nullable();
            $table->text('mws_html_for_footer_menu')->nullable();
            $table->text('mws_css_script_for_inline')->nullable();
            $table->enum('mip_is_show_smiley', ['N', 'Y'])->default('N');
            $table->enum('mip_is_menu_show_presentation_page', ['N', 'Y'])->default('N');
            $table->enum('mws_active_url', ['live_video', 'youtube', 'facebook', 'after_webinar', 'gallery'])->nullable()->default('live_video');
            $table->enum('mws_status', ['active', 'inactive'])->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('1_manag_webinar_streaming');
    }
}
