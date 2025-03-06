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
        Schema::table('user_schoolyear', function (Blueprint $table) {
            // //fk for users and schoolyears
            // $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // $table->foreignId('schoolyear_id')->constrained('schoolyears')->onDelete('cascade');
            if (!Schema::hasColumn('user_schoolyear', 'user_id')) {
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            }
            if (!Schema::hasColumn('user_schoolyear', 'schoolyear_id')) {
                $table->foreignId('schoolyear_id')->constrained('schoolyears')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_schoolyear', function (Blueprint $table) {
            
            //Drop foreign key constraints            $table->dropForeign(['schoolyear_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['schoolyear_id']);
            // Drop columns
            $table->dropColumn(['schoolyear_id']);
            $table->dropColumn(['user_id']);
        });
    }
};
