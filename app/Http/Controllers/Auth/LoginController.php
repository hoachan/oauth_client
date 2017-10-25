<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Socialite;
use App\User;

class LoginController extends Controller
{
    
       /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
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

        $user = User::firstOrNew(['facebook_id' => $fbUser->id]);
        
        if ($user->exists) return $user;
        
        $user->fill([
            'name'      => $fbUser->name,
            'email'     => $fbUser->email,
            'avatar'     => $fbUser->avatar,
            'facebook_id'     => $fbUser->id,
        ])->save();
        
        return $user;
    }
}
