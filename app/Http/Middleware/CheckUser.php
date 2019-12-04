<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if($user){
            return $next($request);
        }else{
            // O Laravel cria /login como rota de forma automática no Auth::routes(), que está no web.php;
            return redirect('/login');
        }
    }
}
