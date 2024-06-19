<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up():void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id(); // article_id
            $table->string('article_title', 255);
            $table->text('article_content');
            $table->timestamps(); // created_at and updated_at columns
            $table->unsignedBigInteger('author_id');

            // Foreign key constraint
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down() :void
    {
        Schema::dropIfExists('articles');
    }
};
