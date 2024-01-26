@extends('admin.layouts.master')
@section('page_title', 'Edit Permission')
@section('content')
    <div class="row d-flex justify-content-center align-items-center " >
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">Edit Permissions</div>
                <div class="card-body">
                    
                    <form class="forms-sample" action="{{ route('permission.update',$permission->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="exampleInputUsername1">Name</label>
                            <input type="text" name="name" class="form-control"  placeholder="Name" value="{{ $permission->name }}">
                        </div>
                    
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a href="{{ route('permission.index')  }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
