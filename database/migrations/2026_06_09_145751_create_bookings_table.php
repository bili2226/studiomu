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
        Schema::create('bookings', function (Blueprint $table) {
            $table->string('id')->primary(); // String primary key (e.g. BOOK-XXXX)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('service_name');
            $table->dateTime('booking_date');
            $table->unsignedInteger('amount');
            $table->string('status')->default('Pending'); // Pending, Confirmed, Completed, Cancelled
            $table->text('requests')->nullable();
            $table->string('snap_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
