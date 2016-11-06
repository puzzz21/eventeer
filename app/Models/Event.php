<?php namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = ['event_name', 'venue', 'event_date', 'event_start_datetime', 'event_end_datetime', 'logo', 'description', 'user_id', 'latitude', 'longitude' , 'special_requirements', 'price', 'tags', 'event_type','country','address','city','registration','seats'];
    
    public function user()
    {
        $this->belongsTo(User::class);
    }
    
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
