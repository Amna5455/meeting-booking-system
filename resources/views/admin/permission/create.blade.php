@extends('admin.layouts.master')
@section('page_title', 'Create Permission')
@section('content')
    <div class="row d-flex justify-content-center align-items-center " >
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">Add New Permissions</div>
                <div class="card-body">
                    
                    <form class="forms-sample" method="post" action="{{ route('permission.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Name</label>
                            <input type="text" name="name" class="form-control"  placeholder="Name" value="{{old('name')}}">
                        </div>
                    
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a href="{{ route('permission.index')  }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
