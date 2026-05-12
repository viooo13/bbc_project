<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SessionExpiry
{
    /**
     * Enforce session inactivity timeout.
     * If session expired and no remember-me cookie, force logout.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $timeoutMinutes = (int) config('session.lifetime', 30);
        $lastActivity = session('last_activity');

        if (Auth::guard('web')->check() && $lastActivity) {
            $elapsed = now()->diffInMinutes(\Carbon\Carbon::createFromTimestamp($lastActivity));

            if ($elapsed > $timeoutMinutes) {
                // Session idle timeout — check if remember-me cookie exists
                if ($request->cookie('remember_me')) {
                    // Let RememberMe middleware handle auto-login
                    // Just destroy session, don't redirect
                    Auth::guard('web')->logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                } else {
                    // No remember-me cookie, force logout and redirect
                    Auth::guard('web')->logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();

                    if (!$request->expectsJson()) {
                        return redirect()->route('showLogin')
                            ->with('info', 'Sesi Anda telah berakhir. Silakan masuk kembali.');
                    }
                }
            }
        }

        // Update last activity timestamp
        if (Auth::guard('web')->check()) {
            session(['last_activity' => now()->timestamp]);
        }

        return $next($request);
    }
}
