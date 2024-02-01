<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CekLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$levels)
    {
        if (in_array($request->user()->level, $levels)) {
            return $next($request);
        }
        // diarahkan sesuai level ketika mengakses halaman yg tidak boleh diakses
        if (Auth::user()->level == 'admin') {
            session()->flash('info', '<strong>Oppss</strong>, Anda tidak memiliki akses ke halaman itu!');
            return redirect()->route('admin');
        }
        else if (Auth::user()->level == 'supporter') {
            session()->flash('info', '<strong>Oppss</strong>, Anda tidak memiliki akses ke halaman itu!');
            return redirect()->route('supporter');
        }else{
            Auth::logout();
            session()->flash('info', '<strong>Oppss</strong>, Anda tidak memiliki akses ke halaman itu!');
            return redirect()->route('login');
        }
    }
}
