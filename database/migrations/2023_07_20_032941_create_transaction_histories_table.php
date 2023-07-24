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
        Schema::create('transaction_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('members_id');
            $table->unsignedBigInteger('copy_postings_id');
            $table->integer('real_postings_id');
            $table->string('status');
            $table->integer('amount')->nullable();
            $table->integer('total');
            $table->timestamps();

            $table->foreign('members_id')->references('id')->on('members');
            $table->foreign('copy_postings_id')->references('id')->on('copy_postings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_histories');
    }
};
