<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpFoundation\Response;

class HandleTokenMismatch
{
    public function handle($request, Closure $next): Response
    {
        try {
            return $next($request);
        } catch (TokenMismatchException $e) {
            // Jika request AJAX atau API, kembalikan JSON
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Sesi Login kadaluarsa, silakan login kembali.',
                ], 419);
            }

            // Kalau request biasa, redirect ke login
            return redirect()
                ->route('login')
                ->with('error', 'Sesi Login kadaluarsa, silakan login kembali.');
        }
    }
}
