<?php

namespace App\Http\Middleware;

use Closure;
use App\Guild;
use App\Alliance;
use RouteParser;

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
        $matches = RouteParser::parse($request->route()->getName());

        switch($matches[1]){
            case 'alliances' :
                if(!isset($request->alliances)){
                    break;
                }
                if(Alliance::findOrFail($request->alliances)->servers[0]->slug != $request->subdomain){
                    abort(403, "Resource does not exist on " + title_case($request->subdomain));
                }
                break;
            case 'guilds' :

                if(!isset($request->guilds)){
                    break;
                }
                if(Guild::findOrFail($request->guilds)->server->slug != $request->subdomain){
                    dd(Guild::findOrFail($request->guilds)->server->slug);
                    abort(403, "Resource does not exist " + title_case($request->subdomain));
                }
                break;
        }
        return $next($request);
    }
}
