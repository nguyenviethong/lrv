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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku')->unique();
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->decimal('price', 12, 2)->default(0);
            $table->integer('quantity')->default(0);
            $table->boolean('is_active')->default(true);
            $table->text('description')->nullable();
            $table->boolean('is_contact')->default(false);
            $table->string('image')->nullable();
            $table->text('title')->nullable();
            $table->json('imageDetails')->nullable();      // danh sách các hình ảnh con
            $table->longText('content')->nullable();   // nội dung chi tiết
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
