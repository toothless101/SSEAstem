<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'schoolyear_id',
        'attendee_id',
        'time_in_am',
        'time_out_am',
        'time_in_pm',
        'time_out_pm'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function schoolyear()
    {
        return $this->belongsTo(SchoolYear::class);
    }

    public function attendee()
    {
        return $this->belongsTo(Attendees::class);
    }
}
