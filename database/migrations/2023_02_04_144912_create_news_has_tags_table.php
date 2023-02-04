<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_has_tags', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->foreignId('news_id')->constrained('news');
            $table->foreignId('tags_id')->constrained('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_has_tags');
    }
};
