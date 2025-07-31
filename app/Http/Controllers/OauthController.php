<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class OauthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback()
    {
        try {
            $githubUser = Socialite::driver('github')->user();

            $findUser = User::where('gauth_id', $githubUser->id)->first();

            if ($findUser) {
                Auth::login($findUser);
            } else {
                $newUser = User::updateOrCreate(
                    ['email' => $githubUser->getEmail()],
                    [
                        'name'      => $githubUser->getName() ?? $githubUser->getNickname(),
                        'gauth_id' => $githubUser->getId(),
                        'password' => bcrypt('foobarrr'),
                        'token'     => $githubUser->token,
                    ]
                );
                Auth::login($newUser);
            }

            return redirect('/dashboard');
        } catch (\Exception $e) {
            dd(get_class($e), $e->getMessage());
        }
    }

    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            $findUser = User::where('gauth_id', $user->id)->first();

            if ($findUser) {
                Auth::login($findUser);

                return redirect('/dashboard');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'gauth_id' => $user->id,
                    'gauth_type' => 'google',
                    'password' => bcrypt('foobarrr'),
                ]);

                Auth::login($newUser);

                return redirect('/dashboard');
            }
        } catch (\Exception $e) {
            dd(get_class($e), $e->getMessage());
        }
    }
}
