<?php

namespace App\Http\Middleware;


use App\Guild;
use App\Alliance;
use App\Group;
use Closure;
use Auth;
use Mockery\CountValidator\Exception;
use Role;


class RoleMiddleware
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
        $route = $request->route()->getName();

        preg_match('/^([a-z]+)\.([a-z]+(\.[a-z]+)*)$/', $route, $matches);
        $resource = $matches[1];

        $object = null;
        switch($resource){
            case 'alliances':
                $object = Alliance::find($request->alliances);
                break;
            case 'guilds':
                $object = Guild::find($request->guilds);
                break;
            case 'group':
                $object = Group::find($request->groups);
                break;
        }

        if(Role::haveRoleFor($route, Auth::getUser(), $object)){
            return $next($request);
        }

        return abort(403, "Access forbidden !");
    }

}
