<?php

namespace App\Http\Controllers\Fonctionnaire\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Fonctionnaire\Auth\LoginRequest;
use App\Models\Fonctionnaire;
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
        return view("fonctionnaire.auth.login");
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        
        $request->authenticate();

        $request->session()->regenerate();
        return redirect()->intended(route("fonctionnaire.index"));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('fonctionnaire')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('fonctionnaire.login');
    }
}
