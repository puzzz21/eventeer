<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    protected $table = "profiles";

    protected $fillable = ['name', 'address', 'phone_number', 'user_id', 'interested_events','created_at', 'updated_at'];

    public $timestamps = true;
}
