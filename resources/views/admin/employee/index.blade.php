@extends('admin.layouts.master')
@section('page_title', 'Employees')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card ">
                <div class="card-header">All Roles</div>
                <div class="card-body">
                    <div class="text-right"><a href="{{ url('admin/employee/create') }}" class="btn btn-primary mb-3"><i class="mdi mdi-plus"></i> Add New</a></div>
                    <div class="table-responsive">
                      <table class="table" id="employee_table">
                        <thead>
                            <tr>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Department</th>
                              <th>Status</th>
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
        $('#employee_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
            url: "{{ route('employee.index') }}",
            },
            columns: [
            {
                data: 'id',
                name: 'id'
            },
           
            {
                data: 'name',
                name: 'name'
            },
           
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'department_id',
                name: 'department_id'
            },
            {
                data: 'status',
                name: 'status'
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
