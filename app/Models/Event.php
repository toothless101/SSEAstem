<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $fillable = [
        'event_name',
        'event_type',
        'event_venue',
        'event_start_date',
        'event_end_date',
        'event_starttime_am',
        'event_endtime_am',
        'event_starttime_pm',
        'event_endtime_pm',
        'morning_in_start',
        'morning_in_end',
        'morning_out_start',
        'morning_out_end',
        'afternoon_in_start',
        'afternoon_in_end',
        'afternoon_out_start',
        'afternoon_out_end',
        // 'user_id'
        'schoolyear_id'
    ];


    public function users(){
        return $this->belongsToMany(User::class, 'event_user')
        ->withPivot('assignment_type')->withTimestamps();
    }


    //to ensure proper handling of time and date values
    protected $casts = [
        'event_start_date'    => 'date',
        'event_end_date'      => 'date',
        'event_starttime_am'  => 'datetime:H:i',
        'event_endtime_am'    => 'datetime:H:i',
        'event_starttime_pm'  => 'datetime:H:i',
        'event_endtime_pm'    => 'datetime:H:i',
        'morning_in_start'    => 'datetime:H:i',
        'morning_in_end'      => 'datetime:H:i',
        'morning_out_start'   => 'datetime:H:i',
        'morning_out_end'     => 'datetime:H:i',
        'afternoon_in_start'  => 'datetime:H:i',
        'afternoon_in_end'    => 'datetime:H:i',
        'afternoon_out_start' => 'datetime:H:i',
        'afternoon_out_end'   => 'datetime:H:i',
    ];

    protected $dates = ['eventdate'];
    
    //attendance and event relationship
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function schoolyear()
    {
        return $this->belongsTo(SchoolYear::class, 'schoolyear_id');
    }
}
