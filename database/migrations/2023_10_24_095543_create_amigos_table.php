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
        Schema::create('amigos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id_uno');
            $table->unsignedBigInteger('user_id_dos');
            $table->boolean('estado_peticion');

            $table->foreign('user_id_uno')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id_dos')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amigos');
    }
};
