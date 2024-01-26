<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $disable_dates = ['2024-01-28'];
        $employees = Employee::all();
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
        // dd($time_array);
        return view('user.index', compact('disable_dates', 'employees','time_array'));
    }
}
