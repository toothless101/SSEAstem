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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->foreignId('schoolyear_id')->constrained('schoolyears')->onDelete('cascade');
            $table->foreignId('attendee_id')->constrained('attendees')->onDelete('cascade');
            $table->timestamp('time_in_am')->nullable();
            $table->timestamp('time_out_am')->nullable();
            $table->timestamp('time_in_pm')->nullable();
            $table->timestamp('time_out_pm')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
