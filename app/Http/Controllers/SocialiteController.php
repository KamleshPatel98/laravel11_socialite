<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function loginSocial(Request $request, string $provider)
    { 
        return Socialite::driver($provider)->redirect();
    }

    public function callbackSocial(Request $request, string $provider)
    {
        $response = Socialite::driver($provider)->user();
        $user = User::firstOrCreate(
            ['email' => $response->getEmail()],
            ['password' => Str::password()]
        );
        $data = [$provider . '_id' => $response->getId()];
        if ($user->wasRecentlyCreated) {
            $data['name'] = $response->getName() ?? $response->getNickname();
            // event(new Registered($user));
        }
        $user->update($data);
        Auth::login($user, remember: true);
        return to_route('welcome');
    }
}
