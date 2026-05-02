<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BanMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

    
        if ($user && $user->status === 'banned') {
            return redirect('/login')
                ->withErrors([
                    'email' => 'Your account has been banned.'
                ]);
        }

        return $next($request);
    }
}
