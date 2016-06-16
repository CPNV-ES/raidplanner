<?php

namespace App\Classes;

use Mockery\CountValidator\Exception;
use RouteParser as Parser;

class Role{
    private $roles = [
        'groups' => [
            'edit' => ['master'],
            'update' => ['master'],
            'destroy' => ['master'],
            'members' => [
                'edit' => ['officer', 'master'],
                'add' => ['officer', 'master'],
                'kick' => ['officer', 'master'],
                'update' => ['officer', 'master'],
                'ban' => ['officer', 'master'],
                'unban' => ['master'],
            ],
            'quit' => ['member', 'officer'],
        ],
        'guilds' => [
            'edit' => ['master'],
            'update' => ['master'],
            'destroy' => ['master'],
            'members' => [
                'edit' => ['officer', 'master'],
                'add' => ['officer', 'master'],
                'kick' => ['officer', 'master'],
                'update' => ['officer', 'master'],
                'ban' => ['officer', 'master'],
                'unban' => ['master'],
            ],
            'alliances' => [
                'quit' => ['member', 'officer'],
            ],
            'quit' => ['member', 'officer'],
        ],
        'alliances' => [
            'edit' => ['master'],
            'update' => ['master'],
            'destroy' => ['master'],
            'members' => [
                'edit' => ['officer', 'master'],
                'add' => ['officer', 'master'],
                'kick' => ['officer', 'master'],
                'update' => ['officer', 'master'],
                'ban' => ['officer', 'master'],
                'unban' => ['master'],
            ],
        ]
    ];

    public function haveRoleFor($route, $user, $target){
        $matches = Parser::parse($route);
        $resource = $matches[1];
        $action = $matches[2];

        if(Parser::isNestedResource($action)){
            $nested = Parser::getNestedResource($action);
            $subResource = $nested[1];
            $action = $nested[2];

            if(!array_key_exists($action, $this->roles[$resource][$subResource])) {
                return true;
            }
            $permit = $this->roles[$resource][$subResource][$action];
        }
        else {
            if(!array_key_exists($action, $this->roles[$resource])) {
                return true;
            }
            $permit = $this->roles[$resource][$action];
        }


        switch($resource) {
            case "groups" :
                $role = $this->getGroupRole($user, $target);
                break;
            case "guilds" :
                $role = $this->getGuildRole($user, $target);
                break;
            case "alliances" :
                $role = $this->getAllianceRole($user, $target);
                break;
            default :
                return false;
                break;
        }

        if(empty($role)){
            return false;
        }

        if(!in_array($role, $permit)){
            return false;
        }

        return true;
    }

    private function getGuildRole($user, $guild){
        $memberOf = $user->memberOfGuild($guild)->first();

        if(empty($memberOf)){
            return false;
        }

        return $memberOf->role;
    }

    private function getAllianceRole($user, $alliance){
        $guilds = $alliance->guilds;

        if($guilds->isEmpty()){
            throw new Exception("No guild in Alliance {$alliance->id} !");
        }

        foreach($guilds as $guild){
            if($guild->alliance_role == "master"){
                if($user->id == $guild->usersByRole('master')->first()->id){
                    return "master";
                }

                /* User not master of the master guild */
                return false;
            }
        }

        throw new Exception("No master guild in Alliance {$alliance->id} !");
    }

    private function getGroupRole($user, $group){
        $memberOf = $user->memberOfGroup($group)->first();

        if(empty($memberOf)){
            return false;
        }

        return $memberOf->role;
    }
}