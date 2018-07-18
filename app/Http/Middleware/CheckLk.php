<?php

namespace App\Http\Middleware;

use Closure;
//use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
//use \Auth;

class CheckLk
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

        if (Auth::check()) {
            // wpadmin
            if( Auth::user()->email == 'agrotmn2016@mail.ru' ){
                return $next($request);
            }
        }

        //if ($request->age <= 200) {
            return redirect('/');
        //}


    }
}
