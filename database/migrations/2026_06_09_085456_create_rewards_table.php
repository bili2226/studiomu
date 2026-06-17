<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rewards', function (Blueprint $table) {
            $table->id();
            $table->string('name');                         // Nama reward
            $table->text('description')->nullable();         // Deskripsi singkat
            $table->string('code')->unique();               // Kode voucher unik
            $table->unsignedInteger('points_required');     // Poin yang dibutuhkan
            $table->string('type')->default('discount');    // discount | free_session | other
            $table->unsignedInteger('discount_amount')->nullable(); // Nominal diskon (Rp)
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->unsignedInteger('stock')->nullable();   // null = unlimited
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rewards');
    }
};
