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
        Schema::create('setting_sections', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // tên section: hero, about, services, ...
            $table->boolean('is_active')->default(true); // bật/tắt
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_sections');
    }
};
