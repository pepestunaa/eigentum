<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    private const ALLOWED_PROVIDERS = ['google'];

    public function redirect($provider)
    {
        if (!in_array($provider, self::ALLOWED_PROVIDERS)) {
            return redirect()->route('login.index')->with('error', 'Provider tidak didukung');
        }

        return Socialite::driver($provider)->redirect();
    }

    public function callback(Request $request, $provider)
    {
        if (!in_array($provider, self::ALLOWED_PROVIDERS)) {
            return redirect()->route('login.index')->with('error', 'Provider tidak didukung');
        }

        try {
            $socialUser = Socialite::driver($provider)->user();

            $user = User::where([
                'provider' => $provider,
                'provider_id' => $socialUser->id,
            ])->first();

            if (!$user) {
                $existing = User::where('email', $socialUser->getEmail())->first();

                if ($existing) {
                    // same email already registered: link this provider to it
                    // instead of crashing on the unique constraint
                    $existing->update([
                        'provider' => $provider,
                        'provider_id' => $socialUser->getId(),
                        'provider_token' => $socialUser->token,
                        'avatar' => $socialUser->getAvatar(),
                        'email_verified_at' => $existing->email_verified_at ?? now(),
                    ]);
                    $user = $existing;
                } else {
                    $user = User::create([
                        'name' => $socialUser->getName(),
                        'email' => $socialUser->getEmail(),
                        'provider' => $provider,
                        'provider_id' => $socialUser->getId(),
                        'provider_token' => $socialUser->token,
                        'avatar' => $socialUser->getAvatar(),
                        'email_verified_at' => now(),
                    ]);
                }
            }

            Auth::login($user);
            $request->session()->regenerate();

            return redirect('/');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return back()->with('error', 'Terjadi kesalahan pada sistem, silakan coba lagi.');
        }
    }
}
