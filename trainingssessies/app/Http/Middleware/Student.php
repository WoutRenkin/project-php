<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\AcademyYear;

class Student
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
        if (auth()->user()->user_kind_id == 1) {

            $academyYear = AcademyYear::where('active',1)->firstOrFail();
            $userAcademyYears = Auth::user()->StudentAcademyYears()->where('academy_year_id', $academyYear->id)->first();
            if(!$userAcademyYears) {

                return redirect('logout');
            } else {
                return $next($request);
            }
        }
        return abort(403, 'Deze pagina is alleen beschikbaar voor studenten.');
    }
}
