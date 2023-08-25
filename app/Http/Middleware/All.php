<?php

namespace App\Http\Middleware;

use Closure;
use Auth, Redirect;

class All
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
        if(Auth::check()){
            if(Auth::User()->level=='1'){
                if(Auth::User()->aktif=='Y'){
                    return $next($request);
                }else{
                    Auth::logout();
                    return Redirect::route('login')->with('title', 'Peringatan !')->with('message', 'User tidak aktif')->with('type', 'error');
                }
            }else if(Auth::User()->level=='2'){
                return $next($request);
            }else{
                return $next($request);
            }
        }else{
            $url = route('login').'?next_url='.$request->path();
            return redirect($url);
        }
    }
}
