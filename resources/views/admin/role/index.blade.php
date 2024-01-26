@extends('admin.layouts.master')
@section('page_title', 'Roles')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card ">
                <div class="card-header">All Roles</div>
                <div class="card-body">
                    <div class="text-right"><a href="{{ url('admin/role/create') }}" class="btn btn-primary mb-3"><i class="mdi mdi-plus"></i> Add New</a></div>
                    <div class="table-responsive">
                      <table class="table" id="role_table">
                        <thead>
                            <tr>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Created At</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                      </table>
                    </div>
                  </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    $(document).ready( function () {
        $('#role_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
            url: "{{ route('role.index') }}",
            },
            columns: [
           
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'actions',
                name: 'actions'
            }
            ]
        });
    });

 </script>
@endsection
