<?php

namespace App\Http\Controllers\Apogee\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apogee\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
          
        return view("apogee.auth.login");
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route("apogee.index"));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('apogee')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('apogee.login');
    }
}
