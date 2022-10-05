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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('news_api_id')->nullable();
            $table->string('source_id')->nullable();
            $table->string('source_name')->nullable();
            $table->string('author')->nullable();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('url')->nullable();
            $table->longText('urlToImage')->nullable();
            $table->string('publishedAt')->nullable();
            $table->longText('content')->nullable();
            $table->timestamps();
            $table->foreign('news_api_id')->references('id')->on('news_apis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
