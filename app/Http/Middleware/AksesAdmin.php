<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class AksesAdmin
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
        //print_r($request->session()->get('sesi'));
        if ($request->session()->get('sesi')) {
            return $next($request);
        } else {
            return redirect()->back()->with('message', 'Hanya admin yang memiliki akses');
        }
        // if ($request->session()->has('sesi')) {
        //     // return redirect()->back()->withErrors(['message' => 'Hanya admin yang memiliki akses',]);
        //     return redirect()->back()->with('message', 'Hanya admin yang memiliki akses',);
        // }
        // return $next($request);
    }
}
