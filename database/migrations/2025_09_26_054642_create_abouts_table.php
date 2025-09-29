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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Tiêu đề chính
            $table->text('intro')->nullable(); // Đoạn mô tả italic
            $table->text('content')->nullable(); // Nội dung chính
            $table->string('image')->nullable(); // Ảnh about

            // Cho phép nhiều item (icon, heading, description)
            $table->json('items')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
