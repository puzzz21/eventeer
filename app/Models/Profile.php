<?php namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';

    protected $fillable = ['name', 'address', 'phone_number', 'interested_events', 'photo', 'user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
