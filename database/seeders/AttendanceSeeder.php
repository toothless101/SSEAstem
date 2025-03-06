<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('attendances')->insert([
            [
                'user_id' => 2,
                'event_id' => 1,
                'schoolyear_id' => 1,
                'attendee_id' => 1,
                'time_in_am' => Carbon::now()->format('Y-m-d H:i:s'),
                'time_out_am' => null,
                'time_in_pm' => null,
                'time_out_pm' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 3,
                'event_id' => 1,
                'schoolyear_id' => 1,
                'attendee_id' => 1,
                'time_in_am' => Carbon::now()->format('Y-m-d H:i:s'),
                'time_out_am' => Carbon::now()->addHours(3)->format('Y-m-d H:i:s'),
                'time_in_pm' => Carbon::now()->addHours(4)->format('Y-m-d H:i:s'),
                'time_out_pm' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
