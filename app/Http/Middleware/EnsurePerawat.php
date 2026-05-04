<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class EnsurePerawat
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

        if ($user->role !== 'perawat') {
            abort(403, 'Akses hanya untuk perawat.');
        }

        return $next($request);
    }
}
