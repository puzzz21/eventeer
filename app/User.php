<?php namespace App;

use App\Models\Enrollment;
use App\Models\Event;
use App\Models\Profile;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
  
}
