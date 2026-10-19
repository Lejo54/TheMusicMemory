<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\MyUser;


class AuthenticateMyUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    $login = $request->session()->get('user_login');
    $user  = $login ? MyUser::find($login) : null;

    if (!$user) {
        $request->session()->flush();
        return to_route('view_signin');
    }

    $request->setUserResolver(fn () => $user);
    return $next($request);
}
}

