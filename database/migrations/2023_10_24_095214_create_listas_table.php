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
        Schema::create('listas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('id_tipo');
            $table->unsignedBigInteger('id_post');


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_tipo')->references('id')->on('tipos')->onDelete('cascade');
            $table->foreign('id_post')->references('id')->on('posts')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listas');
    }
};
