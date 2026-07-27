<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    /**
     * Arahkan user ke dashboard sesuai role setelah login.
     */
    public function index(): RedirectResponse
    {
        $user = auth()->user();

        return match (true) {
            $user->hasRole('admin') => redirect()->route('admin.dashboard'),
            $user->hasRole('operator') => redirect()->route('operator.dashboard'),
            $user->hasRole('user') => redirect()->route('user.dashboard'),
            default => redirect()->route('login')->withErrors([
                'email' => 'Akun Anda belum memiliki peran yang valid. Hubungi administrator.',
            ]),
        };
    }
}