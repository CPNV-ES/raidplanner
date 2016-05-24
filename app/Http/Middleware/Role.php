<?php

namespace App\Http\Middleware;


use App\Guild;
use App\Alliance;
use App\Group;
use Closure;
use Illuminate\Support\Facades\Auth;
use Mockery\CountValidator\Exception;

class Role
{

    private $roles = [
        'groups' => [
            'edit' => ['master'],
            'update' => ['master'],
            'edit_members' => ['officer', 'master'],
            'action_member' => ['officer', 'master'],
            'destroy' => ['master']
        ],
        'guilds' => [
            'edit' => ['master'],
            'update' => ['master'],
            'edit_members' => ['officer', 'master'],
            'action_member' => ['officer', 'master'],
            'destroy' => ['master']
        ],
        'alliances' => [
            'edit' => ['master'],
            'update' => ['master'],
            'edit_members' => ['master'],
            'action_member' => ['master'],
            'destroy' => ['master']
        ]
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        preg_match('/^([a-z]+)\.([a-z\_]+)$/', $request->route()->getName(), $matches);
        $resource = $matches[1];
        $action = $matches[2];

        if(!array_key_exists($action, $this->roles[$resource])){
            return $next($request);
        }

        $user = Auth::getUser();

        switch($resource) {
            case "groups" :
                $role = $this->getGroupRole($user, Group::find($request->groups));
                break;
            case "guilds" :
                $role = $this->getGuildRole($user, Guild::find($request->guilds));
                break;
            case "alliances" :
                $role = $this->getAllianceRole($user, Alliance::find($request->alliances));
                break;
            default :
                abort(500, "Internal Server Error");
                break;
        }

        if(in_array($role, $this->roles[$resource][$action])){
            return $next($request);
        }

        abort(403, "Access denied");
    }
    private function getGuildRole($user, $guild){
        $memberOf = $user->memberOfGuild($guild)->firstOrFail();

        return $memberOf->role;
    }
    protected function getAllianceRole($user, $alliance){
        $guilds = $alliance->guilds;

        if($guilds->isEmpty()){
            throw new Exception();
        }

        foreach($guilds as $guild){
            if($guild->alliance_role == "master"){
                foreach($guild->usersByRole('master')->get() as $guild_user){
                    if($user->id == $guild_user->id){
                        return "master";
                    }
                }
            }
        }

        throw new Exception();
    }
    private function getGroupRole($user, $group){
        $memberOf = $user->memberOfGroup($group)->firstOrFail();

        return $memberOf->role;
    }
}
