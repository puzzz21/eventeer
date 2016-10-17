<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Profile;
use Auth;
use Image;
use DB;

class userController extends Controller
{
    protected $profile;

    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }

    public function profile()
    {
        $profile = $this->profile->where('user_id', '=', auth()->user()->id)->first();

        if ($profile) {
            if ($profile->interested_events) {
                $interestedEvents = array_flip(explode(',', $profile->interested_events));
            } else {
                $interestedEvents = [];
            }
        }

        return view('profileForm', compact('profile', 'interestedEvents'));
    }

    public function updateAvatar(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $avatar   = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('/images/uploads/avatar/' . $filename));
            $user         = Auth::user();
            $user->avatar = $filename;
            $user->save();

            return view('profileForm', array('user' => Auth::user()));

        }
    }

    public function password(Request $request){
        $result="your password is updated";
        $current=Auth::user()->password;
        $current_pass=$request->current_pass;
        $new_pass=$request->new_pass;
        $re_new_pass=$request->re_new_pass;
        if($current==$current_pass){
            if($new_pass==$re_new_pass){
                DB::insert('update users set password=$new_pass where id=Auth::user()->id');
            }
            else
            {
                $result="your new password and re-typed password mismatch";
            }

        }
        else
        {
            $result="you typed your password wrong";
        }
        return view('profileForm',compact('result'));

    }

    public function profileUpdate(Request $request)
    {
        $userId = Auth::user()->id;
//        $photo="/images/uploads/avatar/{{ Auth::user()->avatar }}";
        $name              = $request->name;
        $interested_events = $request->checked;

        if ($interested_events != "") {
            $interested_events = implode(",", $interested_events);
        }

        $address   = $request->address;
        $country   = $request->country;
        $state     = $request->state;
        $city      = $request->city;
        $contact   = $request->contact;
        $about_you = $request->About_you;

        if ($profileId = $request->has('id')) {
            $profile = $this->profile->find($profileId);

            $profile->update(
                [
                    'name'              => $name,
                    'address'           => $address,
                    'city'              => $city,
                    'country'           => $country,
                    'state'             => $state,
                    'desciption'        => $about_you,
                    'contact'           => $contact,
                    'interested_events' => $interested_events,
                    'user_id'           => $userId
                ]
            );
        } else {
            $this->profile->create(
                [
                    'name'              => $name,
                    'address'           => $address,
                    'city'              => $city,
                    'country'           => $country,
                    'state'             => $state,
                    'desciption'        => $about_you,
                    'contact'           => $contact,
                    'interested_events' => $interested_events,
                    'user_id'           => $userId
                ]
            );
        }

        return redirect()->to('/profile')->withSuccess('Profile updated.');
    }

}
