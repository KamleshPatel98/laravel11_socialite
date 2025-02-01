<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Str;
use Auth;
use Hash;

class SocialiteController extends Controller
{
    public function loginSocial(Request $request, string $provider)
    { 
        return Socialite::driver($provider)->redirect();
    }

    public function callbackSocial(Request $request, string $provider)
    {
        $response = Socialite::driver($provider)->stateless()->user();
        $user = User::updateOrCreate(
            ['email' => $response->getEmail()],
            [
                'name' => $response->getName() ?? $response->getNickname(),
                'google_id' => $provider == "google" ? $response->getId() : null,
                'facebook_id' => $provider == "facebook" ? $response->getId() : null,
                'github_id' => $provider == "github" ? $response->getId() : null,
                'password' => Hash::make(Str::password()),
            ]
        );
        Auth::login($user, remember: true);
        return to_route('welcome');
    }
}
