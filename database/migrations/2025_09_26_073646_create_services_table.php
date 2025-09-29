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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');       // tiêu đề service
            $table->string('icon')->nullable(); // icon class (bi bi-activity, fa fa-user, ...)
            $table->text('description')->nullable();
            $table->string('link')->nullable(); // optional: link đến chi tiết
            $table->boolean('is_active')->default(true);
            $table->longText('content')->nullable();   // nội dung chi tiết
            $table->string('image')->nullable();
            $table->json('features')->nullable();      // danh sách các bullet (ul li)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
