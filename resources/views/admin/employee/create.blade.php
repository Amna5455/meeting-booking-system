@extends('admin.layouts.master')
@section('page_title', 'Create Employee')
@section('content')
    <div class="row d-flex justify-content-center align-items-center " >
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">Add New Employee</div>
                <div class="card-body">
                    
                    <form class="forms-sample" method="post" action="{{ route('employee.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" id="first_name" name="first_name" class="form-control"  placeholder="First Name" value="{{old('first_name')}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" class="form-control"  placeholder="Last Name" value="{{old('last_name')}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control"  placeholder="Email" value="{{old('email')}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="department" >Department</label>
                                   <select class="form-control" name="department">
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                   </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" id="password" name="password" class="form-control"  placeholder="Password" value="{{old('password')}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="confirm-password" class="form-label">Confirm Password</label>
                                    <input type="password" id="confirm-password" name="confirm-password" class="form-control"  placeholder="Confirm Password" value="{{old('confirm-password')}}">
                                </div>
                            </div>
                            
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="status" >Status</label>
                                   <select class="form-control" id="status" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">inActive</option>
                                   </select>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a href="{{ route('employee.index')  }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
   
</script>
@endsection

