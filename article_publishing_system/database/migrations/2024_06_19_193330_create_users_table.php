<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // User Id
            $table -> string("user_name",20);
            $table ->string("user_email",256) ->unique();
            $table ->string("user_password",256);
            $table -> string("user_pic",256);
            $table -> string("user_bio",128);
            $table->unsignedBigInteger('user_role');
            $table->timestamps();

            //Foreign Key
            $table->foreign('user_role')->references('id')->on('user_roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
