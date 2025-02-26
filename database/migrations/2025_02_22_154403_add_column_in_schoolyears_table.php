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
        Schema::table('schoolyears', function (Blueprint $table) {
            //
            $table->boolean('is_active')->default(false); //add is_active button for the schoolyear
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schoolyears', function (Blueprint $table) {
            //
        });
    }
};
