<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class EnsureDokterOrPerawat
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = User::current();

        if (! $user) {
            return redirect('/login');
        }

        if (! $user->isDokterOrPerawat()) {
            abort(403, 'Akses hanya untuk dokter atau perawat.');
        }

        return $next($request);
    }
}
