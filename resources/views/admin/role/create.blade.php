@extends('admin.layouts.master')
@section('page_title', 'Create Role')
@section('content')
    <div class="row d-flex justify-content-center align-items-center " >
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">Add New Role</div>
                <div class="card-body">
                    
                    <form class="forms-sample" method="post" action="{{ route('role.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Name</label>
                            <input type="text" name="name" class="form-control"  placeholder="Name" value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <strong>Permissions:</strong>
                            <div class=" mt-2">
                                <input type="checkbox" id="checkall" />
                                <label for="checkall">Select all</label>
                            </div>
                            <div class="row mt-2">
                                
                                @foreach ($permission as $value)
                                    <div class="col-4 ">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input checkbox" name="permission[]"
                                                id="permission-{{ $value->id }}" value="{{ $value->id }}">
                                            <label class="form-check-label" for="permission-{{ $value->id }}">
                                                {{ $value->name }} </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a href="{{ route('role.index')  }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    $(document).ready(function () {
        $('#checkall').click(function (event) {
            if (this.checked) {
                $('.checkbox').each(function () { //loop through each checkbox
                    $(this).prop('checked', true); //check
                });
            } else {
                $('.checkbox').each(function () { //loop through each checkbox
                    $(this).prop('checked', false); //uncheck
                });
            }
        });
    });

</script>
@endsection

