<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                //User route
                $route = 'index';
                //Etudiant route
                if($guard === 'etudiant'){
                    $route = 'etudiant.index';
                }
                if($guard === 'apogee'){
                    $route = 'apogee.index';
                }
                if($guard === 'decanat'){
                    $route = 'decanat.index';
                }
                if($guard === 'professeur'){
                    $route = 'professeur.index';
                }
                if($guard === 'doctrant'){
                    $route = 'doctrant.index';
                }
                if($guard === 'fonctionnaire'){
                    if(Auth::guaed("fonctionnaire")->user()->tache ==="multitache")
                    $route = 'fonctionnaire.index';
                    else
                    abort(404);
                }
                return redirect()->route($route);
            }
        }

        return $next($request);
    }
}
