<?php

namespace App\Http\Middleware\LoginMiddleware;

use App\Models\Student;
use App\Models\User;
use Closure;

class IsStudentUser
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

        if ($user->profile_type != Student::class) {
            return redirect('/admin');
        }
        return $next($request);
    }
}
