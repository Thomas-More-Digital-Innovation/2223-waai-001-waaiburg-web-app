<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view("auth.login");
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): View | RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // dd($request->user());

        // send user to auth.two-factor-challenge if correctly filled in then send to home
        if ($request->user()->two_factor_secret) {
            return view('auth.two-factor-challenge');
        }
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Handle 2fa requests
     */
    public function twoFactorCheck(TwoFactorLoginRequest $request){
        function hasValidCode()
        {
            return $this->code && app(TwoFactorAuthenticationProvider::class)->verify(
                decrypt($this->challengedUser()->two_factor_secret), $this->code
            );
        }

        $user = $request->challengedUser();
        dd($user);

        if ($code = $request->validRecoveryCode()) {
            $user->replaceRecoveryCode($code);
        } elseif (! $request->hasValidCode()) {  // This always return false
            return app(FailedTwoFactorLoginResponse::class);
        }

        $this->guard->login($user, $request->remember());

        return app(TwoFactorLoginResponse::class);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard("web")->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect("/");
    }
}
