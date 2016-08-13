<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use DB;
use App\Http\Requests;

class profileController extends Controller
{
    protected $profile;

    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profileForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $details = $request->except('_token');
        $file =$details['logo'];

        $destinationPath = public_path(). '/public/upload/';
        $filename = $file->getClientOriginalName();
        $file->move($destinationPath, $filename);

        $details['photo'] = $filename;

        $profile = $this->profile->newInstance($details);

        $profile->user()->associate(auth()->user());

        $profile->save();
//        $profile = auth()->user()->profile()->create($details);

        return redirect()->route('profile.show', $profile->id);
//        $fname=$request->fname;
//        $uname=$request->uname;
//        $interested_events=$request->interested_events;
//        $password=$request->password;
//        $location=$request->location;
//        $contact_number=$request->contact_number;
//        DB::insert('insert into profile(id,fname, uname, interested_events, password, location, contact_number) values (?, ?, ?, ?, ?, ?, ?)',[ 4,$fname, $uname,$interested_events, $password, $location,$contact_number]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = $this->profile->findOrFail($id);

        return view('userProfile', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
