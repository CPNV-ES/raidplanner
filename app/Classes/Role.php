<?php

namespace App\Classes;

use Mockery\CountValidator\Exception;

class Role{
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

    public function haveRoleFor($route, $user, $target){
        preg_match('/^([a-z]+)\.([a-z\_]+)$/', $route, $matches);
        $resource = $matches[1];
        $action = $matches[2];

        if(!array_key_exists($action, $this->roles[$resource])){
            return true;
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

        if(!in_array($role, $this->roles[$resource][$action])){
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
                return null;
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