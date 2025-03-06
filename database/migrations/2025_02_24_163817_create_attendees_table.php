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
        Schema::create('attendees', function (Blueprint $table) {
            $table->id();
            $table->string('rollno')->unique(); //Unique Roll Number
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('department');
            $table->string('program')->nullable();
            $table->string('major')->nullable();
            $table->string('year_level')->nullable();
            $table->string('grade_level')->nullable();
            $table->string('section')->nullable(); //Section of the student
            $table->string('track')->nullable();
            $table->string('strand')->nullable();
            $table->string('img')->nullable();
            $table->string('email_add')->unique();
            $table->string('address')->nullable();
            $table->string('mobile_no')->nullable();
            $table->foreignId('schoolyear_id')->constrained('schoolyears')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendees');
    }
};
