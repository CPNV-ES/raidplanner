<?php

namespace App\Http\Middleware;

use Closure;

class Role
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
        dd($request);
        preg_match('/^([a-z]+)\.([a-z)+)$/', $request->route()->getActionName(), $match);

        dd($match);
        $right = [
            'group' => [
                'edit' => 'master',
                'edit send' => 'master',
                'edit member' => 'officer',
                'action member' => 'officer',
                'delete' => 'master'
            ],
            'guild' => [
                'edit' => 'master',
                'edit send' => 'master',
                'edit member' => 'officer',
                'action member' => 'officer',
                'delete' => 'master'
            ],
            'alliance' => [
                'edit' => 'master',
                'edit send' => 'master',
                'edit member' => 'master',
                'action member' => 'master',
                'delete' => 'master'
            ]
        ];
        dd($request);
        return $next($request);
    }
    private function getGuildRight($user){

    }
    private function getAllianceRight($user){

    }
    private function getGroupRight($user){

    }
}
