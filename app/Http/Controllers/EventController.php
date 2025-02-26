<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    
    public function event(){
        $events = Event::latest()->get();
        $officers = User::where('usertype', 2)->get();

        // Iterate through each event to set start_time and end_time
    foreach ($events as $event) {
        // Set default values
        $start_time = 'N/A';
        $end_time = 'N/A';
        $startDate = Carbon::parse($event->event_start_date)->format('F d, Y');
        $endDate = Carbon::parse($event ->event_end_date )->format('F d, Y');

        // Check the event type and set the times accordingly
        if ($event->event_type == 1) { // Whole day
            $start_time = $event->event_starttime_am ? Carbon::parse($event->event_starttime_am)->format('h:i A') : 'N/A';
            $end_time = $event->event_endtime_pm ? Carbon::parse($event->event_endtime_pm)->format('h:i A') : 'N/A';
        } elseif ($event->event_type == 2) { // Half day Morning
            $start_time = $event->event_starttime_am ? Carbon::parse($event->event_starttime_am)->format('h:i A') : 'N/A';
            $end_time = $event->event_endtime_am ? Carbon::parse($event->event_endtime_am)->format('h:i A') : 'N/A';
        } elseif ($event->event_type == 3) { // Half day Afternoon
            $start_time = $event->event_starttime_pm ? Carbon::parse($event->event_starttime_pm)->format('h:i A') : 'N/A';
            $end_time = $event->event_endtime_pm ? Carbon::parse($event->event_endtime_pm)->format('h:i A') : 'N/A';
        }

        
        // Add start_time and end_time to the event
        $event->start_time = $start_time;
        $event->end_time = $end_time;
        $event->startDate = $startDate;
        $event->endDate = $endDate;
    }

        return view ('admin.pages.event.event', compact('events', 'officers'));
    }

    public function createEvent(Request $request)
    {

        // dd($request->all());
        //Valdate the request
        $request->validate([
            'event_name' =>'required|string|max:255',
            'event_type' => 'required|integer|in:1,2,3',
            'event_venue' => 'required|string|max:255',
            'event_start_date' => 'required|date',
            'event_end_date' => 'required|date|after_or_equal:event_start_date',
            'event_starttime_am' => 'nullable|date_format:H:i',
            'event_endtime_am' => 'nullable|date_format:H:i',
            'event_starttime_pm' => 'nullable|date_format:H:i',
            'event_endtime_pm' => 'nullable|date_format:H:i',
            'morning_in_start' => 'nullable|date_format:H:i',
            'morning_in_end' => 'nullable|date_format:H:i',
            'morning_out_start' => 'nullable|date_format:H:i',
            'morning_out_end' => 'nullable|date_format:H:i',
            'afternoon_in_start' => 'nullable|date_format:H:i',
            'afternoon_in_end' => 'nullable|date_format:H:i',
            'afternoon_out_start' => 'nullable|date_format:H:i',
            'afternoon_out_end' => 'nullable|date_format:H:i',
            'assigned_officers' => 'nullable|string',
    
        ]);

        // if ($validator->fails()) {
        //     dd($validator->errors()); // This will dump validation errors and stop execution
        // }

        try{
            //create the event
          $event = Event::create([
                'event_name' => $request->event_name,
                'event_type' => $request->event_type,
                'event_venue' => $request->event_venue,
                'event_start_date' => $request->event_start_date,
                'event_end_date' => $request->event_end_date,
                'event_starttime_am' => $request->event_starttime_am,
                'event_endtime_am' => $request->event_endtime_am,
                'event_starttime_pm' => $request->event_starttime_pm,
                'event_endtime_pm' => $request->event_endtime_pm,
                'morning_in_start' => $request->morning_in_start,
                'morning_in_end' => $request->morning_in_end,
                'morning_out_start' => $request->morning_out_start,
                'morning_out_end' => $request->morning_out_end,
                'afternoon_in_start' => $request->afternoon_in_start,
                'afternoon_in_end' => $request->afternoon_in_end,
                'afternoon_out_start' => $request->afternoon_out_start,
                'afternoon_out_end' => $request->afternoon_out_end,
            ]);
           
            //save assigned officers
            if($request->assigned_officers){
                $assignedOfficers = json_decode($request->assigned_officers, true);

                foreach($assignedOfficers as $user_id => $role){
                    $event->users()->attach($user_id, ['assignment_type' => $role]);
                }
            }

            return redirect()->route('manage_event')->with('success_add_event', 'Event added Successfully');
        } catch(\Exception $e){
            return redirect()->back()->with('error_add_event', 'Error: '. $e->getMessage());
        }
    }

    public function showEvent($event_id){
        $event = Event::findOrFail($event_id);

        $officers = $event->users()->wherePivot('assignment_type', '!=', 'unassigned')->get();        //set default values
        $start_time = 'N/A';
        $end_time = 'N/A';
        $startDate = Carbon::parse($event->event_start_date)->format('F d, Y');
        $endDate = Carbon::parse($event ->event_end_date )->format('F d, Y');

        //chec the event type and display correct start time and event end time
        if($event->event_type == 1) //Wholeday
        {
            $start_time = $event->event_starttime_am ? Carbon::parse($event->event_starttime_am)->format('h:i A') : 'N/A';
            $end_time = $event->event_endtime_pm ? Carbon::parse($event->event_endtime_pm)->format('h:i A') : 'N/A';
        }elseif($event->event_type == 2)//Halfday Morning
        {
            $start_time = $event->event_starttime_am ? Carbon::parse($event->event_starttime_am)->format('h:i A') : 'N/A';
            $end_time = $event->event_endtime_am ? Carbon::parse($event->event_endtime_am)->format('h:i A') : 'N/A';
        }elseif($event->event_type == 3)//Halfday Afternoon
        {
            $start_time = $event->event_starttime_pm ? Carbon::parse($event->event_starttime_pm)->format('h:i A') : 'N/A';
            $end_time = $event->event_endtime_pm? Carbon::parse($event->event_endtime_pm)->format('h:i A') : 'N/A';
        }

        return view('admin.pages.event.event', compact('event','start_time','end_time','startDate','endDate', 'officers'));
    }

    public function editEvent(Request $request, $event_id){
        $event = Event::find($event_id);

        return view('admin.pages.event.event-modals.edit-event-modal', compact('event'));
    }
}