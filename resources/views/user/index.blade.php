@extends('user\layouts\master')

@section('title','Book Your Meeting')
  
@section('content')
<div class="hotel_booking_table">
    <div class="col-md-3">
        <h2>Book<br> Your Meeting</h2>
    </div>
    <div class="col-md-9">
        <div class="boking_table">
            <form method="post" action="{{ url('customer/booking/store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="book_tabel_item">
                            <div class="form-group">
                                <div class='input-group ' >
                                    <input type='text' class="form-control " name="booking_date" id="booking_date" placeholder="Date"/>
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <select class="wide " name="time" style="overflow-y: scroll;min-width:200px">
                                        <option value="" data-display="Time">Time</option>
                                        @foreach ($time_array as $time)
                                        <option value="{{$time}}">{{$time}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="book_tabel_item">
                            <div class="input-group">
                                <select class="wide" name="employee">
                                    <option value="" data-display="Employee">Employee</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->user->first_name.' '.$employee->user->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type='text' class="form-control form-input" name="organizer" placeholder="Organizer"/>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="book_tabel_item">
                            <div class="form-group">
                            <div class="input-group">
                                <input type='text' name="title" class="form-control form-input" placeholder="Title"/>
                            </div>
                            </div>
                            <button type="submit" class="book_now_btn button_hover ">Book Now</button>
                            
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        //var disable_dates = {!! $disable_dates !!};
        var currentDate = new Date();
        
        
        $('#booking_date').datepicker({
            minDate: currentDate,
            dateFormat: 'yy-mm-dd',
            {{--  beforeShowDay: function(date) {
                var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                return [disable_dates.indexOf(string) == -1];
            },  --}}
        });
    </script>
@endsection