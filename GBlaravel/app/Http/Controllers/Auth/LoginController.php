<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Adaptors\UserAdaptor;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function socLogin($soc) 
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return Socialite::driver($soc)->redirect();
        
    }

    public function socResponse(UserAdaptor $userAdaptor, $soc) 
    {
        if (!Auth::check()) {
            $user = Socialite::driver($soc)->user();
            $userInSystem = $userAdaptor->getUserBySocId($user, $soc);
            Auth::login($userInSystem);
        }
        return redirect()->route('home');
    }

}
