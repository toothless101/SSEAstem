<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    //
    use HasFactory;
    protected $table = 'schoolyears';   //tells the laravel the corrected table being created not school_year
    
    protected $fillable = [
        'schoolyear',
        'is_active'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_schoolyear')->withTimestamps();
    }

    //define a relatonship between the SchoolYear and Attendees
    public function attendees()
    {
        return $this->hasMany(Attendees::class);
    }
}
