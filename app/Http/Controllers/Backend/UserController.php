<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Backend\User;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminUserRequest;
use App\Events\Backend\NewAdminCreated;
use App\Events\Backend\NewAdminApproved;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\AdminProfileRequest;

class UserController extends Controller
{
    public function index()
    {
        return view('backend.users.index');
    }

    public function dataTable()
    {
        $outputs = User::select(['id', 'fname', 'lname', 'username', 'email', 'status_id']);

        return DataTables::of($outputs)
            ->addColumn('actions', function($query){
                return '<a href="'.route("admin.users.details", $query->id) .'" class="btn btn-sm btn-primary view"><i class="fa fa-eye"></i> </a> <a href="'.route("admin.users.edit", $query->id) .'" data-user="'. $query->id .'" class="btn btn-sm btn-info edit '. ($query->roleIs('Super Admin') ? "disabled" : "").'"><i class="fa fa-edit"></i> </a> <a href="'.route("admin.users.remove", $query->id) .'" class="btn btn-sm btn-danger delete '. ($query->roleIs('Super Admin') ? "disabled" : "").'"><i class="fa fa-trash"></i> </a>';
            })
            ->addColumn('name',function ($query) {
                return $query->name;
            })
            ->addColumn('role',function ($query) {
                return $query->role;
            })
            ->addColumn('status',function ($query) {
                return $query->status->name;
            })
           ->rawColumns(['actions', 'name', 'role', 'status'])
            ->make(true);
    }

    public function test(Request $request)
    {
        return User::first()->can('assign status');
        // return $request->user()->role();
    }
    public function create()
    {
        return view('backend.auth.register');
    }

    public function store(AdminUserRequest $request)
    {
        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'postal_address' => $request->postal_address,
            'status_id' => $request->status_id,
        ]);

        $role = Role::findOrFail($request->role_id);
        $assignRole = $user->assignRole($role->name);

        if($user && $assignRole)
        {
            if($request->status_id == 3)
            {
                event(new NewAdminApproved($user));
                return ['status' => 'Success', 'message' => 'New admin created successfully.'];
            }

            event(new NewAdminCreated($user));

            return ['status' => 'Success', 'message' => 'New admin created successfully.'];
        } else {
            return ['status' => 'Oops!', 'message' => 'Something went wrong.'];
        }
    }

    public function update (AdminUserRequest $request)
    {
        $user = User::findOrFail($request->id);
        $updateUserProfile = $user->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'status_id' => $request->status_id,
        ]);

        $role = Role::findOrFail($request->role_id);
        $syncRole = $user->syncRoles($role->name);

        if($user && $syncRole)
        {
            if($request->status_id == 3)
            {
                event(new NewAdminApproved($user));
                return ['status' => 'Success', 'message' => 'Admin user updated successfully.'];
            }

            event(new NewAdminCreated($user));

            return ['status' => 'Success', 'message' => 'Admin user updated successfully.'];
        } else {
            return ['status' => 'Oops!', 'message' => 'Something went wrong.'];
        }
    }

    // User functions
    public function profile(Request $request){
        return view('backend.users.profile')->with('user', $request->user());
    }

    public function editProfile(Request $request)
    {
        // return view('backend.users.edit')->with('user', $request->user());
        return view('backend.users.edit');
    }

    public function updateProfile (AdminProfileRequest $request)
    {
        $user = User::findOrFail($request->id);
        $updateUserProfile = $user->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'city' => $request->city,
            'zip_code' => $request->zip_code,
            'country' => $request->country,
            'postal_address' => $request->postal_address,
        ]);

        if($request->has('avatar'))
        {
            // return $request->avatar;
            $updateUserAvatar = $user->addMediaFromRequest('avatar')->toMediaCollection('avatar');

            if($updateUserAvatar)
            {
                $user->update([
                    'avatar' => $user->getFirstMediaUrl('avatar'),
                ]);
            }
        }

        if($updateUserAvatar)
        {
            return ['status' => 'Success', 'message' => 'Admin prifile updated successfully.'];
        } else {
            return ['status' => 'Oops!', 'message' => 'Something went wrong.'];
        }
    }

    public function showPasswordForm()
    {
        return view('backend.auth.passwords.change');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
             'old_password' => 'required',
             'password' => 'required|string|min:6|confirmed'
        ]);

        $user = $request->user();

        if (Hash::check($request->old_password, $user->password)) {
            $updatePassword = $user->update(['password' => Hash::make($request->password)]);
            if ($updatePassword) {
                if($request->expectsJson())
                {
                    return ['status' => 'Success', 'message' => 'Password has been updated successfully.'];
                }
                return back()->with('status', 'Password has been updated successfully');
            } else {
                if($request->expectsJson())
                {
                    return ['status' => 'Warning', 'message' => 'Oops..! Something went wrong!'];
                }
                return back()->with('warning', 'Oops..! Something went wrong!');
            }
        } else {
            if($request->expectsJson())
            {
                return ['status' => 'Success', 'message' => 'Please, make sure you provide the right info!'];
            }
            return back()->with('warning', 'Please, make sure you provide the right info!', 'Oops..!');

        }
    }

    public function view_user(Request $request, User $user)
    {
        return view('backend.users.details')->with('user', $request->user());
    }

    public function get_user(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->role_id = $user->role($user->role)->first()->id;
        return $user;
    }

    public function show(Request $request, $id)
    {
        $user = User::findOrFail($id);
        return view('backend.users.view')->with(compact('user'));
    }

    public function approve(User $user)
    {
        if ($user->approve()) {
            event(new NewAdminApproved($user));
            return back()->with('status', 'User Profile has been approved successfully.');
        }
    }

    public function destroy(User $user)
    {
        if ($user->delete()){
            Alert::success('User has been trashed successfully', 'Great!')->persistent("Close this");
            return back();
        } else {
            return $this->sendFailedResponse();
        }
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function getUsers()
    {
        return 'yes';
    }
}
