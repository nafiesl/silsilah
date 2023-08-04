<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //Google Login
    public function redirectToGoogle(){
        return Socialite::driver('google')->stateless()->redirect();
    }

    //Google callback  
    public function handleGoogleCallback(){
        $user = Socialite::driver('google')->stateless()->user();
        return $this->_registerorLoginUser($user);
    }

    protected function _registerorLoginUser($data){
        $user = User::where('email', $data->email)->first();
        if ($user) {
            Auth::login($user);
            return redirect()->route('home');
        } else {
            return redirect()->route('register');
        }
    }
}
