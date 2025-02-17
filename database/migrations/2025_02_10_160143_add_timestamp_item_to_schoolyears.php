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
            if (!Schema::hasColumn('schoolyears', 'created_at') && !Schema::hasColumn('schoolyears', 'updated_at')) {
                $table->timestamps(); // Adds created_at & updated_at columns
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schoolyears', function (Blueprint $table) {
            //
            $table->dropTimestamps();
        });
    }
};
