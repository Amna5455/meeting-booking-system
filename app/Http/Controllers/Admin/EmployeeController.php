<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index()
    {

        if (request()->ajax()) {
            // $users =  User::whereHas('roles', function ($query) {$query->where('id', 2);})->orderBy('created_at', 'DESC')->get();
            $users =  Employee::orderBy('id', 'DESC')->get();
            
            $userr = auth()->user();
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->user->first_name.' '.$row->user->last_name;
                })
                ->addColumn('email', function ($row) {
                    return $row->user->email;
                })
                ->addColumn('department_id', function ($row) {
                    // dd($row->department->name);
                   return $row->department->name;
                })
                ->addColumn('status', function ($row) {
                    if($row->user->status == '1'){
                        return '<span class="badge badge-success p-1">Active</span>';
                    }else{
                        return '<span class="badge badge-danger p-1">inActive</span>';
                    }
                   
                })
                ->addColumn('actions', function (Employee $emp) use ($userr) {
                    $btn = '';
                    if ($userr->can('employee-edit')) {
                        $btn = '<a href="' . url("admin/employee/edit/" . encrypt($emp->user->id)) . '" class="btn btn-primary shadow btn-xs sharp mr-1"> <i class="mdi mdi-pencil-box"></i> </a>';
                    }
                    if ($userr->can('employee-delete')) {
                        $btn = $btn . '<a class="btn btn-danger shadow btn-xs sharp" data-toggle="modal" " data-target="#model_' . $emp->user->id . '"><i class="mdi mdi-delete text-white"></i></a>
                        <div class="modal fade" id="model_' . $emp->user->id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Employee</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>

                                </div>
                                <div class="modal-body">
                                    <p>Are you sure ? You want to delete the employee. </p>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
                                    <button class="btn btn-danger "><a href="' . url("admin/employee/delete/" . encrypt($emp->user->id)) . '" style="color:white;">Delete Employee</i></a></button>
                                </div>
                            </div>
                        </div>
                    </div>';
                    }
                    return $btn;
                })
                ->rawColumns(['actions','status'])
                ->make(true);
        }
        return view('admin.employee.index');
    }
    public function create()
    {
        $departments = Department::all();
        return view('admin.employee.create',compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users,email',
            'password'   => 'required|same:confirm-password',
            'first_name' => 'required',
            'last_name' => 'required',
            'department' => 'required',
        ]);
        try {
            
            DB::beginTransaction();
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'status' => $request->status,
                'password'          => Hash::make($request->input('password')),
            ]);
            Employee::create([
                'user_id' => $user->id,
                'department_id' => $request->department,
            ]);
            $role = Role::find(2);
            $user->assignRole([$role->id]);
            DB::Commit();
            return redirect(route('employee.index'))->with('success', 'Employee Created Successfully');
        } catch (\Exception $ex) {
            DB::rollback();
            return back()->with('error', 'Error occured' . $ex->getMessage());
        }
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $departments = Department::all();
        $employee = Employee::where('user_id',$id)->first();
        $user = User::find($id);
        // dd($user,$id);
        return view('admin.employee.edit',compact('departments','employee','user'));
    }
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'email' => ['required', Rule::unique('users')->ignore($id)],
            'first_name' => 'required',
            'last_name' => 'required',
            'department' => 'required',
            'password'   => 'same:confirm-password',
        ]);
        try {
            
            DB::beginTransaction();
            $user = User::where('id',$id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'status' => $request->status,
                'password'          => Hash::make($request->input('password')),
            ]);
            Employee::where('user_id',$id)->update([
                'department_id' => $request->department,
            ]);
            DB::Commit();
            return redirect(route('employee.index'))->with('success', 'Employee Updated Successfully');
        } catch (\Exception $ex) {
            DB::rollback();
            return back()->with('error', 'Error occured' . $ex->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $id = decrypt($id);
            $user = User::find($id);
            $user->roles()->detach();
            $user->delete();
            Employee::where('user_id',$id)->delete();
            DB::Commit();
            return redirect(route('employee.index'))->with('success', 'Employee Deleted Successfully');
        } catch (\Exception $ex) {
            DB::rollback();
            return back()->with('error', 'Error occured' . $ex->getMessage());
        }
    }

}
