<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OneAccountOneDevice
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        // dd($user);
        if ($user && $user->session_token !== $this->getCurrentDeviceId()) {
            // Device ID mismatch, logout the user from the current device
            Auth::logout();
            return redirect()->route('login')->with('error', 'You are logged in from another device.');
        }

        return $next($request);
    }

    private function getCurrentDeviceId()
    {
        // Replace this with your own logic to get the current device ID.
        // For example, you can use the user agent, IP address, or generate a unique identifier based on the device's characteristics.
        return md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);
    }
}

