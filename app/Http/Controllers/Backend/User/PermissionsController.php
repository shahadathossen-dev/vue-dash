<?php

namespace App\Http\Controllers\Backend\User;

use Illuminate\Http\Request;
use App\Models\Backend\User;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.users.permissions');
    }

    public function assignPermissions(Request $request)
    {
        $this->validate($request,[
            'user' => 'required_without:role',
            'role' => 'required_without:user',
            'checkedPermissions' =>'required'
        ]);

       try {
            if(!empty($request->user)){
                $user = User::find($request->user);
                $permissions = $request->checkedPermissions;
                $user->syncPermissions($permissions);
            }

            if(!empty($request->role)){
                $role = Role::findByName($request->role);
                $permissions = $request->checkedPermissions;
                $role->syncPermissions($permissions);
            }

            $this->refreshApp();
            return ['status' => 'Success', 'message' => 'Permissions revised successfully.'];

       } catch (\Throwable $th) {
           return $th;
       }
    }

    public function permissions()
    {
        return Permission::all();
    }

    public function getUserPermissions(Request $request)
    {
        $user = User::find($request->id);
        return $user->getAllPermissions()->pluck('name');
    }

    public function getRolePermissions(Request $request)
    {
        $role = Role::findByName($request->role);
        return $role->getAllPermissions()->pluck('name');
    }

    public function refreshApp()
    {
        $configClear = Artisan::call('config:clear');
        $cacheClear = Artisan::call('cache:clear');
        $routeClear = Artisan::call('route:cache');
        // $viewClear = Artisan::call('view:cache');
        return true; //Return anything
    }
}
