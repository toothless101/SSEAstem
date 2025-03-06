<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Attendees;
use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    //
    public function attendance()
    {   
        return view('admin.pages.attendance.attendance');
    }
    public function storeAttendance(Request $request)
    {
        // Validate request to ensure roll number is provided
        $validated = $request->validate([
            'rollno' => 'required|string',
        ]);

        // Find the attendee based on roll number
        $attendee = Attendees::where('rollno', $request->rollno)->first();

        if (!$attendee) {
            return response()->json(['success' => false, 'message' => 'Invalid Roll Number!'], 404);
        }

        $now = Carbon::now();

        // Find an active event based on current time
        $event = Event::where('start_time', '<=', $now)
            ->where('end_time', '>=', $now)
            ->orderBy('start_time', 'desc')
            ->first();

        if (!$event) {
            return response()->json(['success' => false, 'message' => 'No active event at this time!'], 404);
        }

        $eventType = $event->event_type;

        // Check if attendee already has an attendance record
        $attendance = Attendance::where('attendee_id', $attendee->id)
            ->where('event_id', $event->id)
            ->first();

        // If attendance already exists, update time-out
        if ($attendance) {
            if ($eventType === 2 && !$attendance->time_out_am) {
                if ($now->between($event->morning_out_start, $event->morning_out_end)) {
                    $attendance->time_out_am = $now;
                } else {
                    return response()->json(['success' => false, 'message' => 'Not within allowed timeout period'], 400);
                }
            } elseif ($eventType === 3 && !$attendance->time_out_pm) {
                if ($now->between($event->afternoon_out_start, $event->afternoon_out_end)) {
                    $attendance->time_out_pm = $now;
                }
            } elseif ($eventType === 1) {
                if ($now->hour < 12 && !$attendance->time_out_am) {
                    if ($now->between($event->morning_out_start, $event->morning_out_end)) {
                        $attendance->time_out_am = $now;
                    } else {
                        return response()->json(['success' => false, 'message' => 'Not within allowed timeout period'], 400);
                    }
                } elseif ($now->hour >= 12 && !$attendance->time_out_pm) {
                    if ($now->between($event->afternoon_out_start, $event->afternoon_out_end)) {
                        $attendance->time_out_pm = $now;
                    } else {
                        return response()->json(['success' => false, 'message' => 'Not within allowed timeout period'], 400);
                    }
                }
            }
        } 
        // If no attendance record, create a new one
        else {
            $attendanceData = [
                'user_id' => $attendee->user_id,
                'event_id' => $event->id,
                'schoolyear_id' => $attendee->schoolyear_id,
                'attendee_id' => $attendee->id
            ];

            // Determine time-in based on event type
            if ($eventType === 2) {
                if ($now->between($event->morning_in_start, $event->morning_in_end)) {
                    $attendanceData['time_in_am'] = $now;
                } else {
                    return response()->json(['success' => false, 'message' => 'Not within allowed time-in period'], 400);
                }
            } elseif ($eventType === 3) {
                if ($now->between($event->afternoon_in_start, $event->afternoon_in_end)) {
                    $attendanceData['time_in_pm'] = $now;
                } else {
                    return response()->json(['success' => false, 'message' => 'Not within allowed time-in period'], 400);
                }
            } elseif ($eventType === 1) {
                if ($now->hour < 12) {
                    if ($now->between($event->morning_in_start, $event->morning_in_end)) {
                        $attendanceData['time_in_am'] = $now;
                    } else {
                        return response()->json(['success' => false, 'message' => 'Not within allowed time-in period'], 400);
                    }
                } else {
                    if ($now->between($event->afternoon_in_start, $event->afternoon_in_end)) {
                        $attendanceData['time_in_pm'] = $now;
                    } else {
                        return response()->json(['success' => false, 'message' => 'Not within allowed time-in period'], 400);
                    }
                }
            }

            // Create attendance record
            $attendance = Attendance::create($attendanceData);
        }

        // Save the attendance
        if ($attendance->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Attendance recorded successfully!',
                'student' => [
                    'rollno' => $attendee->rollno,
                    'name' => $attendee->firstname . ' ' . $attendee->lastname,
                    'profile_image' => $attendee->img ? asset('images/attendees/' . $attendee->img) : null
                ],
                'time' => $now->format('h:i A')
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to save attendance!'], 500);
        }
    }
}
