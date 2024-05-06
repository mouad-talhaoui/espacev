<?php

namespace App\Http\Controllers\Professeur\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Professeur\Auth\LoginRequest;
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

        return view("professeur.auth.login");
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route("professeur.index"));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('professeur')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('professeur.login');
    }
}
