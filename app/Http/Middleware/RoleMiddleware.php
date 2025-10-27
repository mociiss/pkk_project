<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role ?? '';

        $allowed = [];
        foreach ($roles as $r) {
            if (!is_string($r) || $r === '') continue;
            $parts = preg_split('/[|,]/', $r);
            foreach ($parts as $p) {
                $p = trim($p);
                if ($p !== '') $allowed[] = strtolower($p);
            }
        }
        $allowed = array_unique($allowed);

        if (empty($allowed)) {
            abort(403, 'Akses tidak diizinkan.');
        }

        if (!in_array(strtolower($userRole), $allowed, true)) {
            abort(403, 'Anda tidak punya akses ke halaman ini.');
        }

        return $next($request);
    }
}
