<?php namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profile';

    protected $fillable = ['name', 'address', 'contact', 'interested_events', 'user_id', 'desciption', 'state', 'city', 'country'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
