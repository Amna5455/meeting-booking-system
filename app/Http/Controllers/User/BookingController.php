<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'employee' => 'required',
            'booking_date'   => 'required',
            'time' => 'required',
        ]);
        $chk = Booking::whereDate('booking_date',$request->booking_date)
                    ->where('time',$request->time)
                    ->where('employee_id',$request->employee)
                    ->first();
        if(!empty($chk)){
            return back()->with('error','The booking with same day & time has been already exist ,kindly s elect a differenct time slot or day!');
        }
        try {
            
            DB::beginTransaction();

            Booking::create([
                'time' => $request->time,
                'booking_date' => $request->booking_date,
                'employee_id' => $request->employee,
                'organizer' => $request->organizer,
                'title' => $request->title,
            ]);
           
            DB::Commit();
            return redirect(route('user.dashboard.index'))->with('success', 'Meeting Booked Successfully');
        } catch (\Exception $ex) {
            DB::rollback();
            return back()->with('error', 'Error occured' . $ex->getMessage());
        }
    }
}
