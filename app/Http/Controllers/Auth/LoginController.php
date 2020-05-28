<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function login(request $request)
    {
       $credentials =  $this->validate($request, [
            'email'           => 'required|max:255|email',
            'password'           => 'required',
        ]);
        if (!Auth::attempt($credentials)) {
             return redirect()->back()
             ->withInput() // with inpput la no k bi reset truong email da nhap
             ->withErrors([
                 'password' => trans('auth.failed'),
            ]);
        }
        $user = User::where('email', $credentials['email'])->first();

        if($user->is_block == 1)
        {
            if(Carbon::now()->gt($user->time_block))
            {
                $user->update(['is_block' => 0]);
                return redirect('/');
            }
            else
            {
                $timeBlock = $user->time_block;
                return redirect('/block');

            }
        }

        if($user->is_admin == User::ADMIN) {
           return redirect('/admin');
        }
        return redirect('/');
    }
}
