@extends('admin.layouts.master')
@section('page_title', 'Employees')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card ">
                <div class="card-header">Current Month All Bookings</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="employee_table">
                            <thead>

                                <tr>

                                    <th rowspan="2">
                                        <strong class="h5 " style="color: #FFD700">Time</strong>

                                    </th>

                                    @foreach ($dates as $date)
                                        <th class=" p-0" style="font-size:12px">{{ $date }}</th>
                                    @endforeach
                                </tr>
                                <tr>

                                    @foreach ($datys as $day)
                                        <th class=" p-0" style="font-size:10px">{{ $day }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($time_array as $time)
                                    <tr>
                                        <td>{{ $time }}</td>
                                        @foreach ($dates_array as $date)
                                            @php
                                                $booking = \App\Models\Booking::whereDate('booking_date', $date)
                                                    ->where('time', $time)
                                                    ->first();
                                                   
                                            @endphp
                                            @if (!empty($booking))
                                                <td><span class="bg-success p-1">B</span></td>
                                            @else
                                                <td>-</td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script></script>
@endsection
