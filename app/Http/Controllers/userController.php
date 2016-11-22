<?php

namespace App\Http\Controllers;

use App\Http\Requests\Eventeer\PasswordRequest;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Models\Profile;
use Auth;
use Illuminate\Support\Facades\Hash;
use Image;
use DB;
use Carbon;

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

        $id= Auth::user()->id;
        $eventt = DB::table('events')->where('user_id', '=', $id)->get();

        $mytime = Carbon\Carbon::now();
       $going  = DB::table('enrollments')
            ->select(
                [
                    'enrollments.enrollment_id as enrollment_id',
                    'events.id as event_id',
                    'events.event_name',
                    'enrollments.enrollment_status',
                    'events.logo',
                    'events.venue',
                    'events.event_start_datetime'
                ]
            )
            ->join('events', 'enrollments.event_id', '=', 'events.id')
            ->where('enrollments.user_id', $id)
            ->where('events.event_start_datetime', '>', $mytime->toDateTimeString())
            ->where('enrollments.enrollment_status', 'going')
            ->get();

        $maybe = DB::table('enrollments')
            ->select(
                [
                    'enrollments.enrollment_id as enrollment_id',
                    'events.id as event_id',
                    'events.event_name',
                    'enrollments.enrollment_status',
                    'events.logo',
                    'events.venue',
                    'events.event_start_datetime'
                ]
            )
            ->join('events', 'enrollments.event_id', '=', 'events.id')
            ->where('enrollments.user_id', $id)
            ->where('events.event_start_datetime', '>', $mytime->toDateTimeString())
            ->where('enrollments.enrollment_status', 'maybe')
            ->get();

        return view('profileForm', compact('profile', 'interestedEvents','eventt','going','maybe'));
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

    public function resetPassword()
    {
        $profile = $this->profile->where('user_id', '=', auth()->user()->id)->first();

        if ($profile) {
            if ($profile->interested_events) {
                $interestedEvents = array_flip(explode(',', $profile->interested_events));
            } else {
                $interestedEvents = [];
            }
        }

        $id= Auth::user()->id;
        $eventt = DB::table('events')->where('user_id', '=', $id)->get();

        $mytime = Carbon\Carbon::now();
        $going  = DB::table('enrollments')
                    ->select(
                        [
                            'enrollments.enrollment_id as enrollment_id',
                            'events.id as event_id',
                            'events.event_name',
                            'enrollments.enrollment_status',
                            'events.logo',
                            'events.venue',
                            'events.event_start_datetime'
                        ]
                    )
                    ->join('events', 'enrollments.event_id', '=', 'events.id')
                    ->where('enrollments.user_id', $id)
                    ->where('events.event_start_datetime', '>', $mytime->toDateTimeString())
                    ->where('enrollments.enrollment_status', 'going')
                    ->get();

        $maybe = DB::table('enrollments')
                   ->select(
                       [
                           'enrollments.enrollment_id as enrollment_id',
                           'events.id as event_id',
                           'events.event_name',
                           'enrollments.enrollment_status',
                           'events.logo',
                           'events.venue',
                           'events.event_start_datetime'
                       ]
                   )
                   ->join('events', 'enrollments.event_id', '=', 'events.id')
                   ->where('enrollments.user_id', $id)
                   ->where('events.event_start_datetime', '>', $mytime->toDateTimeString())
                   ->where('enrollments.enrollment_status', 'maybe')
                   ->get();

        return view('resetPassword', compact('profile', 'interestedEvents','eventt','going','maybe'));


    }

    public function password(PasswordRequest $request)
    {
        $user            = auth()->user();
        $currentPassword = $user->password;
        $oldPassword     = $request->get('current_pass');

        if (Hash::check($oldPassword, $currentPassword)) {
            $newPassword        = $request->get('new_pass');
            $retypedNewPassword = $request->get('re_new_pass');

            if ($newPassword == $retypedNewPassword) {
                $user->password = $newPassword;

                $user->save();

                return redirect()->route('reset.password')->withMessage('Password updated successfully.');
            }

            return redirect()->route('reset.password')->withMessage('Retyped password is incorrect');
        }

        return redirect()->route('reset.password')->withMessage('Current password is incorrect');
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

    public function contacts()
    {
        $user_id    = Auth::user()->id;
        $group_name = DB::table('contacts')->select('group_name', 'id')->where('user_id', '=', $user_id)->get();

        return view('contacts', compact('group_name'));
    }

    public function group(Request $request)
    {

        $group_name = $request->group_name;
        $user_id    = Auth::user()->id;
        DB::table('contacts')->insert(['group_name' => $group_name, 'user_id' => $user_id]);
    }

    public function updateGroup($grp)
    {
        $group = DB::table('contacts')->select('group_name', 'id')->where('id', '=', $grp)->get();


        $contact_list = DB::table('contacts')->select('contact_list')->where('id', '=', $grp)->get();
        foreach ($contact_list as $list) {
            $l = explode(",", $list->contact_list);
        }

        $group_id = $grp;

        $group_name = DB::table('contacts')->select('group_name')->where('id', '=', $grp)->get();
        $group_name = $group_name[0]->group_name;


        return view('updateGroup', compact('l', 'group', 'group_id', 'group_name'));
    }

    public function deleteGrp(Request $request)
    {
        $grp = $request->get('id');

        if (!DB::table('contacts')->where('id', $grp)->delete()) {
            return response()->json(['success' => false]);
        }
//        $group_name = DB::table('contacts')->select('group_name', 'id')->where('user_id', '=', auth()->user()->id)->get();

        return response()->json(['success' => true]);
    }

    public function deleteGroup($email, $grpID, $grpNAME)
    {
        $contact_list = DB::table('contacts')->select('contact_list')->where('id', '=', $grpID)->get();

        foreach ($contact_list as $list) {
            $lis = explode(",", $list->contact_list);
        }
        if (($key = array_search($email, $lis)) !== false) {
            unset($lis[$key]);
        }
        $list = implode(',', $lis);

        DB::table('contacts')->where('id', $grpID)->update(['contact_list' => $list]);


        $contact_list = DB::table('contacts')->select('contact_list')->where('id', '=', $grpID)->get();
        foreach ($contact_list as $list) {
            $l = explode(",", $list->contact_list);
        }

        $group_id = $grpID;

        $group_name = DB::table('contacts')->select('group_name')->where('id', '=', $group_id)->get();
        $group_name = $group_name[0]->group_name;


        return view('updateGroup', compact('l', 'group_id', 'group_name'));


    }

    public function updateGrp(Request $request)
    {
        $group_id   = $request->group_id;
        $group_name = $request->group_name;
        DB::table('contacts')->where('id', $group_id)->update(['group_name' => $group_name]);
        $groupName = DB::table('contacts')->select('group_name')->where('id', '=', $group_id)->get();
        if ($groupName != $group_name) {
            $success = "success";

        }

        $contact_list = DB::table('contacts')->select('contact_list')->where('id', '=', $group_id)->get();
        foreach ($contact_list as $list) {
            $l = explode(",", $list->contact_list);
        }

        return view('updateGroup', compact('l', 'group_id', 'group_name', 'success'));
    }


    public function addEmail(Request $request)
    {

        $group_id       = $request->groupID;
        $group_name     = $request->groupNAME;
        $selectedEmails = $request->selectedEmails;

        $contact_list = DB::table('contacts')->select('contact_list')->where('id', '=', $group_id)->get();

        foreach ($contact_list as $list) {
            $lis = explode(",", $list->contact_list);
        }
        $s  = explode(',', $selectedEmails);
        $c  = array_diff($lis, $s);
        $cc = implode(',', $c);


        if ($cc == "") {
            $q = $selectedEmails;
        } else {
            $q = $cc . ',' . $selectedEmails;
        }

        DB::table('contacts')->where('id', $group_id)->update(['contact_list' => $q]);


        $con = DB::table('contacts')->select('contact_list')->where('id', '=', $group_id)->get();

        foreach ($con as $list) {
            $l = explode(",", $list->contact_list);
        }

        return response()->json(json_encode(['l' => $l, 'group_id' => $group_id, 'group_name' => $group_name]));
    }


}
