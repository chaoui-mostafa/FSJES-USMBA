<?php 
// app/Http/Middleware/ApplyDarkMode.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApplyDarkMode
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->dark_mode) {
            session(['dark_mode' => true]);
        } else {
            session(['dark_mode' => false]);
        }

        return $next($request);
    }
}