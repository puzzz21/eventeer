<?php
namespace App\Http\Controllers\Event;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Event;
use App\Http\Requests\Eventeer\EventRequest;

use Carbon;
use DB;


class EventController extends Controller
{
    protected $event;
    protected $enrollment;
    protected $timevent;

    public function __construct(Event $event, Enrollment $enrollment)
    {
        $this->event      = $event;
        $this->enrollment = $enrollment;
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

        return view('welcome', compact('going', 'maybe'));
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


        return view('event.show', compact('event', 'options', 'enrollment', 'going', 'notgoing', 'maybe', 'aaa'));
    }


    public function rsvp(Request $request)
    {

        $details   = [
            'event_id'          => $request->get('event_id'),
            'enrollment_status' => $request->get('choice'),
            'user_id'           => auth()->user()->id,
            'payment_status'    => "paid"

        ];
        $user_ids  = $this->enrollment->get(['user_id']);
        $event_ids = $this->enrollment->get(['event_id']);

        foreach ($user_ids as $user_id) {
            foreach ($event_ids as $event_id) {
                if (($user_id['user_id'] == $details['user_id']) && ($event_id['event_id'] == $details['event_id'])) {
                    $enrollment = $this->enrollment->firstOrCreate($details);
                } else {
                    $enrollment = $this->enrollment->firstOrCreate($details);
                }
            }

            return json_encode($enrollment->enrollment_status);
        }
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
        $sendgrid = new \SendGrid(env('SENDGRID_USERNAME', 'username'), env('SENDGRID_PASSWORD', 'password'), array("turn_off_ssl_verification" => true));
        $email    = new \SendGrid\Email();
        $email
            ->addTo(auth()->user()->email)
            ->setFrom('puja.maharjan001@gmail.com')
            ->setSubject("Your ticket")
            ->setHtml("This your ticket");
        $sendgrid->sendEmail($email);
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

    public function radSearch(Request $request)
    {
        $radius     = $request->radius;

        $tags       = $request->tags;
        $categories = $request->checked;
        $searchDate = $request->searchDate;

        $lat        = $request->lat;
        $lng        = $request->lng;

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

            if ($this->hasCategory($eventCategories, $categories) || $this->isWithin($date, $event)) {
                $filteredEvents[] = $event;
            }
        }

        return $filteredEvents;
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

}
