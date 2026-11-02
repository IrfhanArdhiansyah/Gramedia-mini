<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Menentukan halaman yg hanya boleh diakses setelah login
        if (Auth::Check()) {
            return $next($request);
        } else {
            return redirect()->route('login')->with('error', 'Silahkan login terlebih dahulu!');
        }
    }
}
