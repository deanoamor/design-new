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
        Schema::create('like_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('members_id');
            $table->unsignedBigInteger('postings_id');
            $table->timestamps();

            $table->foreign('members_id')->references('id')->on('members');
            $table->foreign('postings_id')->references('id')->on('postings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('like_histories');
    }
};
