<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $table = 'registration';

    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'cellPhone',
        'gender',
        'age',
        'event_id',
        'user_id',
        'registration_no'
    ];
}
