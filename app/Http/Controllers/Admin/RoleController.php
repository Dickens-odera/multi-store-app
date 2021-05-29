<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    public function index(){
        $permissions = Permission::orderBy('name','ASC')->get();
        $roles = Role::orderBy('name','ASC')->get();
        return view('admin.roles.index', compact('roles','permissions'));
    }
    
    public function assignRole(){

    }

    public function revokeRole(){

    }

    public function permissions(){
        $permissions = Permission::orderBy('name','ACS')->get();
        return view('admin.roles.show');
    }

    public function rolePermission( $roleId ){

    }

    public function submitRole(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name',
            'permission_id' => 'nullable|integer|exists:permissions,id'
        ]);
        if($validator->fails()){
            return back()->with('error', $validator->errors()->first());
        }else{
            try{
                $existingRole = Role::where('name', $request->name)->exists();
                if($existingRole){
                    return back()->with('error','A similar role exists');
                }else{
                    $newRole = Role::create([
                        'name' => $request->name
                    ]);
                    if($newRole){
                        if($request->has('permission_id')){
                            $permission = Permission::findById($request->permission_id);
                            $newRole->givePermissionTo($permission);
                        }
                        return back()->with('success','Role created successfully');
                    }else{
                        return back()->with('error','Failed to create role, please try again');
                    }
                }
            }catch(\Exception $exception){
                Log::critical('Something went wromg creating new role, ERROR: '.$exception->getMessage());
                return back()->with('error','Something went wromg creating new role');
            }
        }
    }
}
