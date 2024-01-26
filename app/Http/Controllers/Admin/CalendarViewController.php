<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use DateTime;
use Illuminate\Http\Request;

class CalendarViewController extends Controller
{


    public function index(Request $request)
    {

        $bookings = Booking::all();
        $start_time = Carbon::createFromTime(0, 0, 0); // Start time, adjust as needed
        $end_time = Carbon::createFromTime(23, 0, 0);  // End time, adjust as needed
        $time_diff = CarbonInterval::hours(1);         // 1 hour interval

        $time_array = [];

        $current_time = $start_time;

        while ($current_time <= $end_time) {
            $formatted_start_time = $current_time->format('g:i A');

            $current_time->add($time_diff);

            $formatted_end_time = $current_time->format('g:i A');

            $time_range = $formatted_start_time . ' - ' . $formatted_end_time;
            $time_array[] = $time_range;
        }
        $firstDayOfMonth = new DateTime('first day of this month');
        $lastDayOfMonth = new DateTime('last day of this month');

        $currentDate = $firstDayOfMonth;
        $dates =  $datys = $dates_array =  [];
        while ($currentDate <= $lastDayOfMonth) {
            $dates[] =  $currentDate->format('d');
            $datys[] =  $currentDate->format('D');
            $dates_array[] = $currentDate->format('Y-m-d');
            $currentDate->modify('+1 day');
        }
        // dd($dates_array);
        return view('admin.calendar.index', compact('bookings', 'time_array','dates','datys','dates_array'));
    }
}
