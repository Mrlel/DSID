<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPasswordChange
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Si l'utilisateur n'a jamais changé son mot de passe, on le redirige vers la page de modification
            if (!$user->password_changed_at) {
                return redirect()->route('password.change')->with('warning', 'Veuillez changer votre mot de passe.');
            }
        }

        return $next($request);
    }
}
