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
        Schema::table('events', function (Blueprint $table) {
            //
            $table->date('event_start_date');
            $table->date('event_end_date');
            $table->time('event_starttime_am')->nullable();
            $table->time('event_endtime_am')->nullable();
            $table->time('event_starttime_pm')->nullable();
            $table->time('event_endtime_pm')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            //
            $table->dropColumn('event_start_date');
            $table->dropColumn('event_end_date');
            $table->dropColumn('event_starttime_am');
            $table->dropColumn('event_endtime_am');
            $table->dropColumn('event_starttime_pm');
            $table->dropColumn('event_endtime_pm');
            
        });
    }
};
