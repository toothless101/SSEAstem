<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSchoolyear extends Model
{
    //
    use HasFactory;

    protected $table = 'user_schoolyear';
    
    protected $fillable =[
        'user_id',
        'schoolyear_id'
    ];

    //Relationships (belongsTo because the user_schoolyear acts as the linking table (many to many relationship) between users and schoolyear)
    public function users(){
        return $this->belongsTo(User::class);
    }

    public function schoolyears(){
        return $this->belongsTo(SchoolYear::class);
    }
}
