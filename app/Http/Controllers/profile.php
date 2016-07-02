<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;

class profile extends Controller
{
    public function insert()
    {
    	
    	DB::insert('insert into profile(id, name, uname, interested_events, password, location, contact_number) values (?, ?, ?, ?, ?, ?, ?)',[3, 'sdfsf', 'sdfdsf','sdfsd', 'sdfsdf', 'sdfsd','sdfsdf']);
    }
}