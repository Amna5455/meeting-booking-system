<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function index(){

        if (request()->ajax()) {
            $permissions = Role::orderBy('created_at', 'DESC')->get();
            // dd($permissions);
            $userr=auth()->user();
            return DataTables::of($permissions)
                    ->addIndexColumn()
                    ->addColumn('actions', function(Role $role) use ($userr){
                        $btn = '';
                        if ($userr->can('role-edit')){
                        $btn ='<a href="' . url("admin/role/edit/" . encrypt($role->id)) . '" class="btn btn-primary shadow btn-xs sharp mr-1"> <i class="mdi mdi-pencil-box"></i> </a>';}
                        if ($userr->can('role-delete')){
                        $btn=$btn.'<a class="btn btn-danger shadow btn-xs sharp" data-toggle="modal" " data-target="#model_' . $role->id . '"><i class="mdi mdi-delete text-white"></i></a>
                        <div class="modal fade" id="model_' . $role->id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Employee</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>

                                </div>
                                <div class="modal-body">
                                    <p>Are you sure ? You want to delete the role. </p>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
                                    <button class="btn btn-danger "><a href="' . url("admin/permission/".encrypt($role->id)).'" style="color:white;">Delete Employee</i></a></button>
                                </div>
                            </div>
                        </div>
                    </div>';}
                        return $btn;
                    })
                    ->rawColumns(['actions'])
                    ->make(true);

        }
        return view('admin.role.index');
    }
    public function create(){

        $permission = Permission::get();
        return view('admin.role.create',compact('permission'));
    }

    public function store(Request $request)
    {

        // $role = Role::create(['name' => $request->input('name'), 'guard_name' => 'web']);
        // $role->syncPermissions($request->input('permission'));
        // $role = new Role();
        // $role->name = request('name');
        // $role->save();
        // $role->permissions()->sync(request('permission'));
        // return redirect(route('role.index'))->with('success', 'Role Created Successfully');
        $roles = Role::get();
        $permissions = $request->input('permission');
        $notSame = false;
        $sameRole = null;
        for ($i = 0; $i < count($roles); $i++) {
            $role_permissions[$i] = $roles[$i]->getAllPermissions()
                ->pluck('id')->toArray();
            for ($j = 0; $j < count($role_permissions[$i]); $j++) {
                if ($role_permissions[$i] == $permissions) {
                    $notSame = true;
                    $sameRole = $roles[$i];
                    break;
                }
            }
        }
        /**
         * Below condition will check if same set of permissions is
         * not assigned to any other role then It will be processed
         * further otherwise user have to choose different set of
         * permission
         *
         */
        if ($notSame && ($sameRole != null)) {
           return back()->with('error','A role named as "' . $sameRole->name . '" with same permissions already exists try with another permissions set');
        } else {
            $request->validate([
                'name' => 'required|unique:roles,name',
                'permission' =>'required|min:1'
            ]);
            try{
                DB::beginTransaction();
                $role = new Role();
                $role->name = request('name');
                $role->save();
                $role->permissions()->sync(request('permission'));
                DB::Commit();
                return redirect(route('role.index'))->with('success', 'Role Created Successfully');
            }
            catch (\Exception $ex) {
                DB::rollback();
                return back()->with('error', 'Error occured' . $ex->getMessage());
            }
        }
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")
            ->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('admin.role.edit', compact('role', 'permission', 'rolePermissions'));

    }
    public function update(Request $request,$id)
    {
       

        $role = Role::find($id);

        $roles = Role::get();
        $permissions = $request->input('permission');
        $notSame = false;
        $sameRole = null;
        for ($i = 0; $i < count($roles); $i++) {
            $role_permissions[$i] = $roles[$i]->getAllPermissions()
                ->pluck('id')->toArray();
            for ($j = 0; $j < count($role_permissions[$i]); $j++) {
                if (($role_permissions[$i] == $permissions) && ($roles[$i]->id != $id)) {
                    $notSame = true;
                    $sameRole = $roles[$i];
                    break;
                }
            }
        }
        
        /**
         * Below condition will check if same set of permissions is
         * not assigned to any other role then It will be processed
         * further otherwise user have to choose different set of
         * permission
         *
         */

        if ($notSame && ($sameRole != null)) {
            return back()->with('error', 'A role named as "' . $sameRole->name . '" with same permissions already exists try with another permissions set');
        } else {
            // dd($id);
            $request->validate([
                // 'name' => 'required|unique:roles,name,except, id,'.$id,
                'name'=>['required', Rule::unique('roles')->ignore($id)],
                'permission' =>'required|min:1'
            ]);
            try{
                DB::beginTransaction();
                $role=Role::find($id);
                $role->name=request('name');
                $role->save();
                $role->permissions()->sync($request->permission);
                DB::Commit();
                return redirect(route('role.index'))->with('success', 'Role Updated Successfully');

            }
            catch (\Exception $ex) {
                DB::rollback();
                return back()->with('error', 'Error occured' . $ex->getMessage());
            }
        }
    }
}
