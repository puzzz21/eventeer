<?php namespace App\Http\Requests\Eventeer;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'event_name'           => 'required',
            'venue'                => 'required',
            'event_date'           => 'required|date',
            'event_start_datetime' => 'required|date',
            'event_end_datetime'   => 'required|date',
            'description'          => 'required',
        ];
    }

    public function messages()
    {
        return [
            'event_name'           => 'This field is Required',
            'venue'                => 'This field is Required',
            'event_date'           => 'This field is Required',
            'event_start_datetime' => 'This field is Required',
            'event_end_datetime'   => 'This field is Required',
            'description'          => 'This field is Required',
        ];
    }
}
