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
        Schema::create('copy_postings', function (Blueprint $table) {
            $table->id();
            $table->integer('members_id');
            $table->string('member_name');
            $table->integer('postings_id');
            $table->string('image_name');
            $table->string('file_name');
            $table->string('image_url');
            $table->string('file_url');
            $table->string('title');
            $table->text('description');
            $table->integer('price');
            $table->string('status');
            $table->string('type');
            $table->boolean('is_free');
            $table->integer('download');
            $table->integer('like');
            $table->integer('feedback');
            $table->integer('income');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('copy_postings');
    }
};
