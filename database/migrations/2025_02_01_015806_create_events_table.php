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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_name');
            $table->tinyInteger('event_type');
            $table->string('event_venue');    
                
            //attendance time (morning and afternoon)
            $table->time('morning_in_start')->nullable();
            $table->time('morning_in_end')->nullable();
            $table->time('morning_out_start')->nullable();
            $table->time('morning_out_end')->nullable();
            $table->time('afternoon_in_start')->nullable();
            $table->time('afternoon_in_end')->nullable();
            $table->time('afternoon_out_start')->nullable();
            $table->time('afternoon_out_end')->nullable();

            //foreign key to users/officers
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
