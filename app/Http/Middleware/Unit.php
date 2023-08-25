<?php

namespace App\Http\Middleware;

use Closure;
use Auth, Redirect;

class Unit
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
            if(Auth::User()->level=='4'){
                return $next($request);
            }else if(Auth::User()->level=='2'){
                return Redirect::to('dokter');
            }else if(Auth::User()->level=='1'){
                return Redirect::to('/admin');
            } else {
                return Redirect::to('/perawat');
            }
        }else{
            $url = route('login').'?next_url='.$request->path();
            return redirect($url);
        }
    }
}
