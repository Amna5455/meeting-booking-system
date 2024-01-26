<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function index()
    {

        if (request()->ajax()) {
            $permissions = Permission::orderBy('created_at', 'DESC')->get();
            // dd($permissions);
            $userr = auth()->user();
            return DataTables::of($permissions)
                ->addIndexColumn()
                ->addColumn('actions', function (Permission $perm) use ($userr) {
                    $btn = '';
                    if ($userr->can('permission-edit')) {
                        $btn = '<a href="' . url("admin/permission/edit/" . encrypt($perm->id)) . '" class="btn btn-primary shadow btn-xs sharp mr-1"> <i class="mdi mdi-pencil-box"></i> </a>';
                    }
                    return $btn;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('admin.permission.index');
    }
    public function create()
    {
        return view('admin.permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);
        try {
            DB::beginTransaction();
            Permission::create(['name' => $request->name]);
            DB::Commit();
            return redirect(route('permission.index'))->with('success', 'Permission Created Successfully');
        } catch (\Exception $ex) {
            DB::rollback();
            return back()->with('error', 'Error occured' . $ex->getMessage());
        }
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $permission = Permission::find($id);
        return view('admin.permission.edit', compact('permission'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            
            'name'=>['required', Rule::unique('roles')->ignore($id)],
        ]);
        try {
            DB::beginTransaction();
            Permission::where('id', $id)->update(['name' => $request->name]);
            DB::Commit();
            return redirect(route('permission.index'))->with('success', 'Permission Updated Successfully');
        } catch (\Exception $ex) {
            DB::rollback();
            return back()->with('error', 'Error occured' . $ex->getMessage());
        }
    }
}
