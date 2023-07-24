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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->string('username');
            $table->string('image_name')->nullable();
            $table->string('image_url')->nullable();
            $table->string('no_hp')->nullable();
            $table->integer('wallet')->nullable();
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
