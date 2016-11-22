<?php
namespace App\Http\Controllers\Event;

use App\Models\Enrollment;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Event;
use App\Http\Requests\Eventeer\EventRequest;
use Auth;
use App;
use Carbon;
use DB;
use PDF;
use \Milon\Barcode\DNS2D;




class EventController extends Controller
{
    protected $event;
    protected $enrollment;
    protected $timevent;
    protected $registration;

    public function __construct(Event $event, Enrollment $enrollment, Registration $registration)
    {
        $this->event        = $event;
        $this->enrollment   = $enrollment;
        $this->registration = $registration;
        $this->middleware('auth');
        $this->sendGrid = new \SendGrid(env('SENDGRID_USERNAME', 'username'), env('SENDGRID_PASSWORD', 'password'));

    }

    public function create()
    {
        return view('event.create');
    }

    public function hom()
    {
        $mytime = Carbon\Carbon::now();
        $userId = auth()->user()->id;
        $going  = $this->enrollment
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
            ->where('enrollments.user_id', $userId)
            ->where('events.event_start_datetime', '>', $mytime->toDateTimeString())
            ->where('enrollments.enrollment_status', 'going')
            ->get()
            ->take(- 4);

        $maybe = $this->enrollment
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
            ->where('enrollments.user_id', $userId)
            ->where('events.event_start_datetime', '>', $mytime->toDateTimeString())
            ->where('enrollments.enrollment_status', 'maybe')
            ->get()
            ->take(- 4);

        return view('home', compact('going', 'maybe'));
    }

    public function index()
    {
        $userId              = auth()->user()->id;
        $arr                 = array();
        $event_interestArray = array();
        $interested_events   = DB::table('profile')->select('interested_events')->where('user_id', $userId)->get();
        $country_arr         = array();
        $event_countryArray  = array();
        $country_events      = DB::table('profile')->select('country')->where('user_id', $userId)->get();
        $events              = DB::table('events')->get();

        foreach ($events as $event) {
            foreach ($interested_events as $interested_event) {
                $bb = explode(",", $interested_event->interested_events);
                foreach ($bb as $b) {
                    $aa = explode(",", $event->event_type);
                    if (in_array($b, $aa)) {
                        array_push($arr, $event->id);
                    }
                }
            }
        }
        $event_id_array = array_unique($arr);

        foreach ($events as $event) {
            foreach ($country_events as $country) {

                if ($event->country == $country->country) {
                    array_push($country_arr, $event->id);
                }
            }
        }
        $event_countryArray = array_unique($country_arr);

        $recommended = array_intersect($event_id_array, $event_countryArray);


        foreach ($recommended as $recommended_id) {
            $event_recommend = DB::table('events')->where('id', $recommended_id)->take(8)->get();
            array_push($event_interestArray, $event_recommend);
        }


        $mytime = Carbon\Carbon::now();

        $going = $this->enrollment
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
            ->where('enrollments.user_id', $userId)
            ->where('events.event_start_datetime', '>', $mytime->toDateTimeString())
            ->where('enrollments.enrollment_status', 'going')
            ->get()
            ->take(- 4);

        $maybe = $this->enrollment
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
            ->where('enrollments.user_id', $userId)
            ->where('events.event_start_datetime', '>', $mytime->toDateTimeString())
            ->where('enrollments.enrollment_status', 'maybe')
            ->get()
            ->take(- 4);

        $events = $this->event->orderBy('id', 'desc')->get();

        return view('welcome', compact('events', 'event_interestArray'));
    }

    public function store(Request $request)
    {
        $details = $request->all();

        if (array_key_exists('logo', $details)) {
            $file            = $details['logo'];
            $destinationPath = public_path() . '/public/upload/';
            $filename        = $file->getClientOriginalName();
            $file->move($destinationPath, $filename);
            $details['logo'] = $filename;
        }

        if (array_key_exists('event_start_datetime', $details)) {
            $event_start_datetime            = $details['event_start_datetime'];
            $explode_esdt                    = explode(".", $event_start_datetime);
            $explode_esdt_yr                 = explode(" ", $explode_esdt[2]);
            $details['event_start_datetime'] = $explode_esdt_yr[0] . '-' . $explode_esdt[1] . '-' . $explode_esdt[0] . ' ' . $explode_esdt_yr[1] . ':00';

        }
        if (array_key_exists('event_end_datetime', $details)) {
            $event_end_datetime            = $details['event_end_datetime'];
            $explode_eedt                  = explode(".", $event_end_datetime);
            $explode_eedt_yr               = explode(" ", $explode_eedt[2]);
            $details['event_end_datetime'] = $explode_eedt_yr[0] . '-' . $explode_eedt[1] . '-' . $explode_eedt[0] . ' ' . $explode_eedt_yr[1] . ':00';

        }
        if (array_key_exists('tags', $details)) {
            $x               = implode(",", $details['tags']);
            $details['tags'] = $x;
        }
        if (array_key_exists('checked', $details)) {
            $x                     = $details['checked'][0];
            $details['event_type'] = $x;
        }

        $details['user_id'] = auth()->user()->id;
        $event              = $this->event->create($details);


        return redirect()->route('events.show', $event->id);
    }

    public function show($eventId)
    {
        $aaa   = "";
        $bbb   = "";
        $ccc   = "";
        $event = $this->event->findOrFail($eventId);

        $enrollment = $event->enrollments()->where('user_id', '=', auth()->user()->id)->first();

        $going    = $this->enrollment->where('event_id', $eventId)->where('enrollment_status', 'going')->count();
        $notgoing = $this->enrollment->where('event_id', $eventId)->where('enrollment_status', 'not going')->count();
        $maybe    = $this->enrollment->where('event_id', $eventId)->where('enrollment_status', 'maybe')->count();

        $agoing = $this->enrollment->where('event_id', $eventId)->where('enrollment_status', 'going')->where('user_id', '=', auth()->user()->id)->count();
        $bgoing = $this->enrollment->where('event_id', $eventId)->where('enrollment_status', 'not going')->where('user_id', '=', auth()->user()->id)->count();
        $cgoing = $this->enrollment->where('event_id', $eventId)->where('enrollment_status', 'maybe')->where('user_id', '=', auth()->user()->id)->count();


        if ($agoing == 1) {
            $aaa = "you are going to this event!";
        }
        if ($bgoing == 1) {
            $aaa = "you are not going to this event!";
        }
        if ($cgoing == 1) {
            $aaa = "you might go to this event!";
        }

        $user_id    = Auth::user()->id;
        $group_name = DB::table('contacts')->select('group_name')->where('user_id', '=', $user_id)->get();
        $creator    = DB::table('profile')->where('user_id', $event->user_id)->get();

        $registration = DB::table('registration')->where('user_id', $user_id)->where('event_id', $eventId)->get();


        return view('event.show', compact('group_name', 'registration', 'event', 'creator', 'enrollment', 'going', 'notgoing', 'maybe', 'aaa'));
    }

    public function profile($id)
    {
        $profiles = DB::table('profile')->where('id', $id)->get();
        foreach ($profiles as $profile) {
            $user_id = $profile->user_id;
        }
        $events = DB::table('events')->where('user_id', $user_id)->get();
        $avatar = DB::table('users')->where('id', $user_id)->get();
        foreach ($avatar as $a) {
            $pic = $a->avatar;
        }

        return view('profile', compact('profiles', 'pic', 'events'));
    }

    public function emailList(Request $request)
    {
        $emailList = DB::table('contacts')->select('contact_list')->where('group_name', $request->text)->get();

        return response()->json(json_encode($emailList));
    }

    public function rsvp(Request $request)
    {

        $details = [
            'event_id'          => $request->get('event_id'),
            'enrollment_status' => $request->get('choice'),
            'user_id'           => auth()->user()->id,
            'payment_status'    => "paid"

        ];

        $user_id  = $details['user_id'];
        $event_id = $details['event_id'];
//        $event_ids = $this->enrollment->get(['event_id']);
        $enrolled = DB::table('enrollments')->where('user_id', $user_id)->where('event_id', $event_id)->get();

        if ($enrolled == []) {
            $enrollment = $this->enrollment->firstOrCreate($details);


        } else {
            DB::table('enrollments')->update(['enrollment_status' => $details['enrollment_status'], 'event_id' => $details['event_id'], 'user_id' => $details['user_id']]);
        }


//        foreach ($user_ids as $user_id) {
//            foreach ($event_ids as $event_id) {
//                if (($user_id['user_id'] == $details['user_id']) && ($event_id['event_id'] == $details['event_id'])) {
//                    $enrollment = $this->enrollment->firstOrCreate($details);
//                } else {
//                    $enrollment = $this->enrollment->firstOrCreate($details);
//                }
//            }

//            return json_encode($enrollment->enrollment_status);
    }


    public function rsvpshow(Request $request)
    {
        $details = [
            'event_id'          => $request->get('event_id'),
            'enrollment_status' => $request->get('choice'),
            'user_id'           => auth()->user()->id,
            'payment_status'    => $request->get('payment_status')

        ];
        $going   = $this->enrollment->where('event_id', $details['event_id'])->where('enrollment_status', 'not going')->count();

        return view('event.show', compact('going'));
    }

    public function radius(Request $request)
    {
        $abc = $request->all();
        $lat = $abc['lat'];
        $lng = $abc['lng'];
        $rad = $abc['radius'];

        if ($rad == "") {
            $rad = 1;
        }

        $a = DB::select(
            "SELECT * FROM `events` WHERE ACOS( SIN( RADIANS( `latitude` ) ) * SIN( RADIANS( $lat) ) + COS( RADIANS( `latitude` ) )
* COS( RADIANS( $lat )) * COS( RADIANS( `longitude` ) - RADIANS( $lng )) ) * 6380 < $rad"
        );

        return view('radiusPage', compact('lat', 'lng', 'rad', 'a'));
    }

    public function email(Request $request)
    {
        $msg                  = $request->emails;
        $urll                 = $request->urll;
        $event_name           = $request->event_name;
        $venue                = $request->event_venue;
        $description          = $request->description;
        $event_start_datetime = $request->event_start_datetime;
        $event_end_datetime   = $request->event_end_datetime;
        $logo                 = $request->logo;
        $address              = $request->address;
        $city                 = $request->city;
        $country              = $request->country;


        $m  = implode(",", $msg);
        $mm = explode(",", $m);
        foreach ($mm as $e) {
            $sendgrid = new \SendGrid(env('SENDGRID_USERNAME', 'username'), env('SENDGRID_PASSWORD', 'password'), array("turn_off_ssl_verification" => true));
            $email    = new \SendGrid\Email();
            $email
                ->addTo($e)
                ->setFrom(auth()->user()->email)
                ->setSubject("Your friend has invited you to the event")
                ->setHtml(
                    " <p> you are invited to this event... </p> <br/>" .
                    "<h2>" . $event_name . "</h2>" .
                    " <strong> venue  : </strong> " . $venue .
                    " <br/> <strong> location  : </strong> " . $city . " ," . $address . " ," . $country .
                    "<br/> <strong> starts : </strong>" . $event_start_datetime .
                    "<br/> <strong> ends : </strong>" . $event_end_datetime .
//                              "<img src='public/images.$logo' />".
                    "<br/> <br/> Click in the link for more detail " . $urll
                );
            $sendgrid->sendEmail($email);
        }


    }

    public function ticket()
    {
        $this->pdf();
        $sendgrid = new \SendGrid(env('SENDGRID_USERNAME', 'username'), env('SENDGRID_PASSWORD', 'password'), array("turn_off_ssl_verification" => true));
        $email    = new \SendGrid\Email();

        $email
            ->addTo('puzz.mhzn@gmail.com')
            ->setFrom('puja.maharjan001@gmail.com')
            ->setSubject("Your ticket")
            ->setHtml("Here is your ticket. Hope to see you there!")
            ->addAttachment("/home/puzz/homesteadSites/project/public/myfile.pdf");
        
        $sendgrid->sendEmail($email);
    }

    public function pdf()
    {
        $record = DB::table('registration')->where('user_id',Auth::user()->id)->get();
        foreach ($record as $r){
            $rr=$r->registration_no;
            $rf=$r->firstName;
                $rl=$r->lastName;
                    $e=$r->email;
                        $g=$r->gender;
                            $a=$r->age;

        }
        $d = new DNS2D();
        $d->setStorPath(__DIR__."/cache/");

        PDF::loadHTML(
            $d->getBarcodeHTML("9780691147727", "QRCODE").'
<p> your ticket </p>'. Auth::user()->remember_token .'<br/>'. Auth::user()->name.'<br/>'.Auth::user()->email )->setPaper('a4', 'landscape')->setWarnings(false)->save('myfile.pdf');
    }

    public function cat($ca)
    {

        if ($ca == 'music') {
            $cat = $this->event->where('event_type', 'LIKE', '%' . 'music' . '%')->get();
        } elseif ($ca == 'technology') {
            $cat = $this->event->where('event_type', 'LIKE', '%' . 'technology' . '%')->get();
        } elseif ($ca == 'sports & wellness') {
            $cat = $this->event->where('event_type', 'LIKE', '%' . 'sports & wellness' . '%')->get();
        } elseif ($ca == 'classes') {
            $cat = $this->event->where('event_type', 'LIKE', '%' . 'classes' . '%')->get();

        } elseif ($ca == 'food & drinks') {
            $cat = $this->event->where('event_type', 'LIKE', '%' . 'food & drinks' . '%')->get();

        } elseif ($ca == 'arts') {
            $cat = $this->event->where('event_type', 'LIKE', '%' . 'arts' . '%')->get();

        } elseif ($ca == 'causes') {
            $cat = $this->event->where('event_type', 'LIKE', '%' . 'causes' . '%')->get();

        } elseif ($ca == 'networking') {
            $cat = $this->event->where('event_type', 'LIKE', '%' . 'networking' . '%')->get();

        } elseif ($ca == 'parties') {
            $cat = $this->event->where('event_type', 'LIKE', '%' . 'parties' . '%')->get();

        } else {
            $cat = "non of the defined categories are selected";
        }

        return view('event.cat', compact('cat', 'ca'));
    }

    public function search(Request $request)
    {
        if ($request->location != "" && $request->tags == "" && $request->searchDate == "") {
            $result = $this->event->where('city', $request->location)->get();
        } elseif ($request->tags != "" && $request->location == "" && $request->searchDate == "") {
            $result = $this->event->where('tags', 'LIKE', '%' . $request->tags . '%')->get();
        } elseif ($request->location != "" && $request->tags != "" && $request->searchDate == "") {

            $result = $this->event->where('city', $request->location)->where('tags', 'LIKE', '%' . $request->tags . '%')->get();
        } elseif ($request->location != "" && $request->tags != "" && $request->searchDate != "") {
            $explode_esdt    = explode(".", $request->searchDate);
            $explode_esdt_yr = explode(" ", $explode_esdt[2]);
            $datee           = $explode_esdt_yr[0] . '-' . $explode_esdt[1] . '-' . $explode_esdt[0];
            $result          = $this->event->where('city', $request->location)->where('tags', 'LIKE', '%' . $request->tags . '%')->where('event_start_datetime', 'LIKE', '%' . $datee . '%')->get();
        } elseif ($request->tags != "" && $request->searchDate != "" && $request->location == "") {
            $explode_esdt    = explode(".", $request->searchDate);
            $explode_esdt_yr = explode(" ", $explode_esdt[2]);
            $datee           = $explode_esdt_yr[0] . '-' . $explode_esdt[1] . '-' . $explode_esdt[0];
            $result          = $this->event->where('tags', 'LIKE', '%' . $request->tags . '%')->where('event_start_datetime', 'LIKE', '%' . $datee . '%')->get();
        } elseif ($request->location != "" && $request->searchDate != "" && $request->tags == "") {
            $explode_esdt    = explode(".", $request->searchDate);
            $explode_esdt_yr = explode(" ", $explode_esdt[2]);
            $datee           = $explode_esdt_yr[0] . '-' . $explode_esdt[1] . '-' . $explode_esdt[0];
            $result          = $this->event->where('city', $request->location)->where('event_start_datetime', 'LIKE', '%' . $datee . '%')->get();
        } elseif ($request->searchDate != "" && $request->location == "" && $request->tags = "") {
            $explode_esdt    = explode(".", $request->searchDate);
            $explode_esdt_yr = explode(" ", $explode_esdt[2]);
            $datee           = $explode_esdt_yr[0] . '-' . $explode_esdt[1] . '-' . $explode_esdt[0];
            $result          = $this->event->where('event_start_datetime', 'LIKE', '%' . $datee . '%')->get();
        } else {
            $result = "no result found";
        }

        return view('event.searchPage', compact('result'));
    }

    public function searchTag($tag)
    {

        $result = $this->event->where('tags', 'LIKE', '%' . $tag . '%')->get();

        return view('event.searchPage', compact('result'));
    }

    public function radSearch(Request $request)
    {
        $radius     = $request->radius ? $request->radius : 1;
        $tags       = $request->tags;
        $categories = $request->checked;
        $searchDate = $request->searchDate;

        $lat = $request->lat;
        $lng = $request->lng;

        $matches = DB::select(
            "SELECT * FROM `events` WHERE ACOS( SIN( RADIANS( `latitude` ) ) * SIN( RADIANS( $lat) ) + COS( RADIANS( `latitude` ) )
* COS( RADIANS( $lat )) * COS( RADIANS( `longitude` ) - RADIANS( $lng )) ) * 6380 < $radius"
        );

        $events = $this->filterEvents($matches, $request->all());

        return response()->json(json_encode(['lat' => $lat, 'lng' => $lng, 'radius' => $radius, 'a' => $events]));
//        return view('radiusPage', compact('lat', 'lng', 'rad', 'a'));

    }

    /**
     * Filter Events by categories.
     * @param array $events
     * @param       $formData
     * @return array
     */
    protected function filterEvents(array $events, $formData)
    {
        $filteredEvents = [];
        $categories     = $formData['checked'];
        $date           = $formData['searchDate'];

        foreach ($events as $event) {
            $eventCategories = explode(',', $event->event_type);

            if ($this->hasCategory($eventCategories, $categories) || $this->isWithin($date, $event) || $this->isTagged($formData['tags'], $event)) {
                $filteredEvents[] = $event;
            }
        }

        return $filteredEvents ? $filteredEvents : $events;
    }

    /**
     * Check if a given Event's categories falls under the search categories.
     * @param $eventCategories
     * @param $categories
     * @return bool
     */
    protected function hasCategory($eventCategories, $categories)
    {
        if (count(array_intersect($eventCategories, explode(',', $categories)))) {
            return true;
        }

        return false;
    }

    /**
     * Check if the date falls within the events start date and end date.
     * @param $date
     * @param $event
     * @return bool
     */
    protected function isWithin($date, $event)
    {
        $date = strtotime($date);

        return (($date >= strtotime($event->event_start_datetime)) && ($date <= strtotime($event->event_end_datetime)));
    }

    /**
     * Check if an Event is tagged with a specific tag.
     * @param $tag
     * @param $event
     * @return bool
     */
    protected function isTagged($tag, $event)
    {
        return $tag ? array_has(array_flip(explode(',', $event->tags)), $tag) : false;
    }

    public function updateEvent($id)
    {
        $events = DB::table('events')->where('id', '=', $id)->get();

        return view('event.update', compact('events'));

    }

    public function event_update(Request $request)
    {
        $details = $request->all();

        if (array_key_exists('logo', $details)) {
            $file            = $details['logo'];
            $destinationPath = public_path() . '/public/upload/';
            $filename        = $file->getClientOriginalName();
            $file->move($destinationPath, $filename);
            $details['logo'] = $filename;
        }

        if (array_key_exists('event_start_datetime', $details)) {
            $event_start_datetime            = $details['event_start_datetime'];
            $explode_esdt                    = explode(".", $event_start_datetime);
            $explode_esdt_yr                 = explode(" ", $explode_esdt[2]);
            $details['event_start_datetime'] = $explode_esdt_yr[0] . '-' . $explode_esdt[1] . '-' . $explode_esdt[0] . ' ' . $explode_esdt_yr[1] . ':00';

        }
        if (array_key_exists('event_end_datetime', $details)) {
            $event_end_datetime            = $details['event_end_datetime'];
            $explode_eedt                  = explode(".", $event_end_datetime);
            $explode_eedt_yr               = explode(" ", $explode_eedt[2]);
            $details['event_end_datetime'] = $explode_eedt_yr[0] . '-' . $explode_eedt[1] . '-' . $explode_eedt[0] . ' ' . $explode_eedt_yr[1] . ':00';

        }
        if (array_key_exists('tags', $details)) {
            $x               = implode(",", $details['tags']);
            $details['tags'] = $x;
        }
        if (array_key_exists('checked', $details)) {
            $x                     = $details['checked'][0];
            $details['event_type'] = $x;
        }

        DB::table('events')->where('id', $details['event_id'])->update(
            [
                'event_name'           => $details['event_name'],
                'venue'                => $details['venue'],
                'event_start_datetime' => $details['event_start_datetime'],
                'event_end_datetime'   => $details['event_end_datetime'],
                'logo'                 => $details['logo'],
                'description'          => $details['description'],
                'user_id'              => Auth::user()->id,
                'longitude'            => $details['longitude'],
                'latitude'             => $details['latitude'],
                'special_requirements' => $details['special_requirements'],
                'price'                => $details['price'],
                'tags'                 => $details['tags'],
                'event_type'           => $details['event_type'],
                'address'              => $details['address'],
                'country'              => $details['country'],
                'city'                 => $details['city']
            ]
        );

        return redirect()->route('events.show', $details['event_id']);

    }

    public function emailOrganizer(Request $request)
    {
        $name     = $request->name;
        $address  = $request->address;
        $msg      = $request->msg;
        $id       = $request->id;
        $id       = trim($id);
        $orgEmail = DB::table('users')->select('email')->where('id', $id)->get();
        foreach ($orgEmail as $email) {
            $e = $email->email;
        }

        $sendgrid = new \SendGrid(env('SENDGRID_USERNAME', 'username'), env('SENDGRID_PASSWORD', 'password'), array("turn_off_ssl_verification" => true));
        $email    = new \SendGrid\Email();
        $email
            ->addTo($e)
            ->setFrom($address)
            ->setSubject("Your friend has invited you to the event")
            ->setHtml(
                $msg
            );
        $sendgrid->sendEmail($email);

    }

    public function register($id)
    {
        return view('register', compact('id'));
    }

    public function registerForm(Request $request)
    {
        $this->registration->create($request->all());
        $id   = $request->event_id;
        $show = "You have been registered. Check your email for ticket.";

//        return view('register',compact('show','id'));
        return redirect()->route('events.show', $id)->withShow($show);
    }

    public function eventSettingPage()
    {
        $id     = Auth::user()->id;
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

        return view('eventSetting', compact('eventt', 'going', 'maybe'));

    }

    public function deleteEvent(Request $request)
    {
        $grp = $request->get('id');

        if (!DB::table('events')->where('id', $grp)->delete()) {
            return response()->json(['success' => false]);
        }

//        $group_name = DB::table('contacts')->select('group_name', 'id')->where('user_id', '=', auth()->user()->id)->get();

        return response()->json(['success' => true]);
    }


}
