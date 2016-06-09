<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\User;
use App\Guild;

class ProfilesController extends DomainController
{
    /**
     * Display all resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = [];
        $guilds = Guild::onServer($this->server())->with('members')->get();
        foreach($guilds as $guild){
            foreach($guild->members as $member) {
                $users[] = $member;
            }
        }
        return view('profile.index', ['users' => $users]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = User::find($request->user);

        return view('profile.show', ['user' => $user, 'guild' => $user->guilds()->onServer($this->server())->first()]);
    }
}
