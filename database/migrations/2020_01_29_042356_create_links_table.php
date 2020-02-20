<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('domain_id')->unsigned()->default(0)->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->string('slug', 50);
            $table->string('target', 500);
            $table->boolean('enabled')->default(true);
            $table->string('image', 500)->nullable();
            $table->string('main_text', 250)->nullable();
            $table->string('secondary_text', 500)->nullable();
            $table->string('ad_target', 500);
            $table->integer('delay');
            $table->boolean('progress_bar_enabled')->default(true);
            $table->boolean('skip_button_enabled')->default(true);
            $table->string('bg_color', 20)->nullable();
            $table->string('main_text_color', 20)->nullable();
            $table->string('secondary_text_color', 20)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('domain_id')->references('id')->on('domains')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('links');
    }
}
