<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    //
    use HasFactory;
    protected $table = 'schoolyears';   //tells the laravel the corrected table being created not school_year
    protected $primaryKey = 'sy_id';   //tell laravel the correct primary key instead of looking for id from schoolyear table (sy_id)
    public $incrementing = true; 
    protected $keyType = 'int';
    
    protected $fillable = [
        'schoolyear'
    ];
}
