<?php

namespace App\Http\Controllers\Backend\Auth;

use Illuminate\Http\Request;
use App\Models\Backend\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Auth\Access\AuthorizationException;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create password for the first time and verifies email.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPasswordForm(Request $request)
    {
        if(!$request->verified) {
            throw new AuthorizationException;
        }

        $user =  User::findOrFail($request->user);
        return view('backend.auth.passwords.create-password')->with(compact('user'));
    }

    public function createPassword(Request $request)
    {
        $user = User::findOrFail($request->id);

        $this->validate($request, [
             'password' => 'required|string|min:6|confirmed',
        ]);

        if($user->markEmailAsVerified())
        {
            $user->password = Hash::make($request->password);
            $user->status_id = 1;
            $user->save();

            event(new Verified($user));

            if ($request->sign_in) {
                $this->guard()->login($user);
            }

            return $this->redirectPath();
        }
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('backend.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker('admins');
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
