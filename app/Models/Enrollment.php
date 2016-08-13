<?php namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $table = 'enrollments';

    protected $primaryKey = 'enrollment_id';

    protected $fillable = ['enrollment_status', 'payment_status', 'event_id', 'user_id', 'enrolled_at', 'updated_at'];
    
    public function user()
    {
        return $this->hasOne(User::class);
    }
    
    public function event()
    {
        return $this->hasOne(Event::class);
    }
}
