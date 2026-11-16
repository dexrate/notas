<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIsLogged
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //verificar se o usuário está logado
        if (!session('usuario')) {
            return redirect()->to('/login')->with(['login_error' => 'Você precisa estar logado para acessar esta página.']);
        }
        return $next($request);
    }
}
