<?php

namespace App\Http\Middleware\LoginMiddleware;

use App\Models\Admin;
use App\Models\User;
use Closure;

class IsAdminUser
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
        $user = User::find(auth()->user()->id);

        if ($user->profile_type != Admin::class) {
            return redirect('/home');
        }


        return $next($request);
    }
}
