<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'org_type',
        'email',
        'username',
        'password',
        'usertype',
        'user_img',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function events(){
        return $this->belongsToMany(Event::class, 'event_user')
        ->withPivot('assignment_type')
        ->withTimestamps();
    }

    public function schoolyears(){
        return $this->belongsToMany(SchoolYear::class, 'user_schoolyear', 'schoolyear_id', 'user_id')
        ->withTimestamps();
    }

    //USER AN SCHOOLYEAR RELATIONSHIP
    public function userSchoolyears(){
        return $this->hasMany(UserSchoolyear::class, 'user_id', 'id');
    }

    //attendance and user relationship
    public function attendances(){
        return $this->hasMany(Attendance::class);
    }
}
