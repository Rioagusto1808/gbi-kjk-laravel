<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            if (! $user->hasRole('superadmin')) {
                if ($user->jemaat && ! $user->jemaat->aktif) {
                    Auth::logout();

                    return redirect()->route('login')->withErrors([
                        'errors' => 'Akun anda sudah dinonaktifkan.',
                    ]);
                }
            }
        }

        return $next($request);
    }
}
