<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    public function index(){
        $permissions = Permission::orderBy('name','ASC')->get();
        $roles = Role::orderBy('name','ASC')->get();
        return view('admin.roles.index', compact('roles','permissions'));
    }
    
    public function permissions(){
        $permissions = Permission::orderBy('name','ASC')->get();
        return view('admin.roles.show');
    }

    public function newPermission(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:permissions,name'
        ]);
        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }else{
            try{
                if(Permission::create([
                    'name' => $request->name
                ])){
                    return back()->with('success','permission created successfully');
                }else{
                    return back()->with('error','Failed to create permission, please try again');
                }   
            }catch(\Exception $exception){
                Log::critical('Something went wrong creating new permission. ERROR: '.$exception->getMessage());
                return back()->with('error','Something went wrong creating new permission, try again later');
            }
        }
    }

    public function assignPermission(Request $request)
    {
        $role = Role::findById($request->role_id);
        $permission = Permission::findById($request->permission_id);
        try{
            if($role->givePermissionTo($permission)){
                return back()->with('success', $permission->name.' '.'successfully assigned to '.$role->name .'  role');
            }
        }catch(\Exception $exception){
            Log::critical('Could not assifn permission. ERROR '.$exception->getMessage());
            return back()->with('error','Could not assifn permission, please try again');
        }
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
                        if($request->has('permission_id') && $request->permission_id !== ""){
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

    public function users(){
        $users = User::with('roles')->orderBy('name')->paginate(10);
        $roles = Role::orderBy('name','ASC')->get();
        return view('admin.users.index', compact('users', 'roles'));
    }

    public function assignRoleToUser(Request $request, $id)
    {
        $user = User::find($id);
        $validator = Validator::make($request->all(),[
            'role_id' => 'required|exists:roles,id|integer'
        ]);
        if($validator->fails()){
            return back()->with('error', $validator->errors()->first());
        }else{
            try{
                $role = Role::findById($request->role_id);
                if($user->assignRole($role)){
                    return back()->with('success','User successfully asigned '.$role->name.'role');
                }else{
                    return back()->with('error', 'Could not assign role to user, plese try again');
                }
            }catch(\Exception $exception){
                Log::critical('Could not assign role to user, ERROR: '.$exception->getMessage());
                return back()->with('error', 'Could not assign role to user, plese try again later');
            }
        }
    }

    public function user( $id ){
        $user = User::with('roles', 'stores' ,'products', 'drivers', 'purchases')->find($id);
        $roles = Role::orderBy('name','ASC')->get();
        return view('admin.users.show', compact('user', 'roles'));
    }
}
