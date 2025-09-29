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
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // tiêu đề chính
            $table->text('subtitle')->nullable(); // mô tả ngắn
            $table->string('button_text')->nullable(); // text nút "Get Started"
            $table->string('button_link')->nullable(); // link nút
            $table->string('video_link')->nullable(); // link video Youtube
            $table->string('image')->nullable(); // ảnh hero
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_sections');
    }
};
