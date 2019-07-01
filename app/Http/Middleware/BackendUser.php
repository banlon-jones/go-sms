<?php

namespace App\Http\Middleware;

use Closure;
use App\Privilege;
use Illuminate\Support\Facades\DB;

class BackendUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $privilege)
    {
        //dd($request->user()->role()->first());
        $privileges = DB::table('privilege_role')->where('role_id',  $request->user()->role_id )->get()->pluck('privilege_id');
            if ( $privileges->contains($privilege) ) {
                return $next($request);
            }
       return redirect('home')->with('error',' Sorry you can not access this privilege ');
    }
}
