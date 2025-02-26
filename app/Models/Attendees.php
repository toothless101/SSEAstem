<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendees extends Model
{
    //
    use HasFactory;

    protected $table = 'attendees';
    
    protected $fillable = [
        'rollno', 
        'firstname', 
        'middlename', 
        'lastname', 
        'gender', 
        'department', 
        'program', 
        'year_level', 
        'grade_level', 
        'section', 
        'track', 
        'img', 
        'email_add', 
        'address', 
        'mobile_no', 
        'schoolyear_id'
    ];

    //define a relatonship between the Attendees and SchoolYear 
    public function schoolyear()   
    {
        return $this->belongsTo(SchoolYear::class);
    }
}
