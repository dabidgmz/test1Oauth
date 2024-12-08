<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle () {
        return Socialite:: driver ('google')->redirect();
    }

    public function handleGoogleCallback () {
        try {
            $googleUser = Socialite:: driver('google')->stateless()->user();
            $user = User::where('email', $googleUser->getEmail())->first();
            if (!$user) {
            $user = User:: create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'google_id' => $googleUser->getId(),
            'password' => bcrypt ('123456')
            ]);
        }
            Auth:: login ($user);
            return redirect()->intended ('/welcome');
    }
        catch (Exception $error) {
        return redirect ('/welcome')->withErrors(['msg' => 'logueado'.$error->getMessage()]);
        }
    }
}
