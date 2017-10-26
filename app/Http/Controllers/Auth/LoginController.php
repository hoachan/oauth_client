<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Socialite;
use App\User;

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
    
    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }
    
    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $fbUser = Socialite::driver('facebook')->user();

        $user   = $this->findOrCreateFacebookUser($fbUser);

        auth()->login($user);
        
        return redirect('/');
        // $user->token;
    }
    
    public function findOrCreateFacebookUser($fbUser)
    {
        $user = User::firstOrNew(['provider_id' => (string)$fbUser->id]);

        if ($user->exists) return $user;

        $user->fill([
            'name'      => $fbUser->name,
            'email'     => $fbUser->email,
            'avatar'     => $fbUser->avatar,
            'provider_name'     => $fbUser->name,
            'provider_id'     => $fbUser->id,
            'user_info'     => json_encode($fbUser),
        ])->save();
        
        return $user;
    }   
}
