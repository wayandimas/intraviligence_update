<?php

namespace App\Http\Middleware;

use illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class VerifySessionToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->session()->get('user');
        $sessionToken = $request->session()->get('session_token');

        if ($user && $sessionToken && $user->session_token !== $sessionToken) {
            // Token sesi pengguna tidak cocok dengan yang disimpan di database, keluarkan pengguna
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login')->with('error', 'Akun Anda telah masuk dari perangkat lain.');
        }

        return $next($request);
    }
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
