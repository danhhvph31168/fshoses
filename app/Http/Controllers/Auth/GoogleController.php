<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->scopes(['profile', 'email'])
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

            $googleUser = Socialite::driver('google')->user();
            
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'password' => bcrypt('123456dummy'), 
                ]
            );
         
            Auth::login($user);

            return redirect()->route('home')->with('success', 'Login successfully');
        } catch (\Exception $e) {
            return redirect()->route('auth.showFormLogin')->with(['error' => 'Google login failed!']);
        }
    }
}
