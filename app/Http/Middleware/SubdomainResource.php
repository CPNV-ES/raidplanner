<?php

namespace App\Http\Middleware;

use Closure;

class SubdomainResource
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
        preg_match('/^([a-z]+)\.[a-z]+$/', $request->route()->getName(), $matches);

        switch($matches[1]){
            case 'allances' :
                if(Alliance::find($request->alliances)->server[0]->name != $request->subdomain){
                    return false;
                }
                break;
            case 'guilds' :
                if(Guild::find($request->guilds)->server->name != $request->subdomain){
                    return false;
                }
                break;
        }
        return $next($request);
    }
}
