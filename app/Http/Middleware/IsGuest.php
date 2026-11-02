<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()) {
            // kalau udah login, gaboleh akses halaman ini. Jd arahkan kembali ke home
            return redirect()->route('home')->with('error', 'Halaman hanya boleh diakses sebelum login!');
        } else {
            // Jika belum login, maka perbolehkan akses halaman tsb
            return $next($request);
        }
    }
}
