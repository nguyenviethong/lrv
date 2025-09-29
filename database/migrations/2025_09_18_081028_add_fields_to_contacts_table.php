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
        Schema::table('contacts', function (Blueprint $table) {
            if (!Schema::hasColumn('contacts', 'name')) {
                $table->string('name')->nullable();
            }
            if (!Schema::hasColumn('contacts', 'hotline')) {
                $table->string('hotline')->nullable();
            }
            if (!Schema::hasColumn('contacts', 'email')) {
                $table->string('email')->nullable();
            }
            if (!Schema::hasColumn('contacts', 'address')) {
                $table->string('address')->nullable();
            }
            if (!Schema::hasColumn('contacts', 'zalo')) {
                $table->string('zalo')->nullable();
            }
            if (!Schema::hasColumn('contacts', 'message')) {
                $table->text('message')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn(['name','hotline','email','address','zalo','message']);
        });
    }
};
