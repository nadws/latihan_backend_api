<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureStoreSelected
{
    public function handle(Request $request, Closure $next)
    {
        // IZINKAN halaman select-store
        if ($request->routeIs('filament.admin.pages.select-store')) {
            return $next($request);
        }

        // Kalau belum pilih store → paksa ke select-store
        if (! session()->has('active_store_id')) {
            return redirect()->route('filament.admin.pages.select-store');
        }

        return $next($request);
    }
}
