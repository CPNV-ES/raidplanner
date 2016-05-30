<?php

namespace App\Http\Middleware;

use Closure;
use App\Guild;
use App\Alliance;

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
        preg_match('/^([a-z]+)\.[a-z]+/', $request->route()->getName(), $matches);

        switch($matches[1]){
            case 'alliances' :
                if(!isset($request->alliances)){
                    break;
                }
                if(Alliance::findOrFail($request->alliances)->servers[0]->slug != $request->subdomain){
                    abort(403, "Resource does not exist");
                }
                break;
            case 'guilds' :
                if(!isset($request->guilds)){
                    break;
                }
                if(Guild::findOrFail($request->guilds)->server->slug != $request->subdomain){
                    abort(403, "Resource does not exist");
                }
                break;
        }
        return $next($request);
    }
}
