<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Socialite;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(User $user)
    {
       
        $googleUser = Socialite::driver('google')->stateless()->user();
        if(!(User::where('email', $googleUser->email)->first())){
            User::create([
                'name'     => $googleUser->name,
                'email'    => $googleUser->email,
                'password' => $googleUser->id,
            ]);
        }
        $user=User::where('email', $googleUser->email)->first();
        
        //$user['name'] = $googleUser->name;
        //$user['email'] = $googleUser->email;
        //$user['password'] = $googleUser->id;
        Auth::login($user,true);
        return redirect('/');
        
    }
    
}
