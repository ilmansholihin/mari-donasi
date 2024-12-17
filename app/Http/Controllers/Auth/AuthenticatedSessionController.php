<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        // Periksa ID role pengguna dan redirect sesuai role
        if ($user->roles->contains('id', 1)) { // Role ID 1 untuk owner
            return redirect()->route('admin.dashboard.index'); // Halaman untuk owner
        } elseif ($user->roles->contains('id', 2)) { // Role ID 2 untuk buyer
            return redirect()->route('user.home.index'); // Halaman untuk buyer
        }

            return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
