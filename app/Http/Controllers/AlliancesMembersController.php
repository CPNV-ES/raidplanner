<?php

namespace App\Http\Controllers;

use App\Guild;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Alliance;
use Illuminate\Support\Facades\Auth;
use Role;

class AlliancesMembersController extends DomainController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            return view('alliances.members.index', ['alliance' =>   Alliance::find($request->alliances), 'guilds' => Guild::where('alliance_id', null)->get()]);
    }
    
    public function add(Request $request)
    {
        $alliance = Alliance::find($request->alliances);
        $guilds = Guild::where('alliance_id', null)->get();
        foreach ($guilds as $guild) {
                if ($request->has($guild->id)) {
                    $guild->alliance_id = $alliance->id;
                    $guild->alliance_role = "member";
                    $guild->save();
                }
        }
        return view('alliances.members.index', ['alliance' =>   Alliance::find($request->alliances), 'guilds' => Guild::where('alliance_id', null)->get()]);
    }

    public function kick(Request $request){
       $guild = Guild::find( $request->input('guild_id'));

        if($guild->alliance_role != "master"){
            $guild->alliance_id = null;
            $guild->alliance_role = null;
            $guild->save();
        }

        return view('alliances.members.index', ['alliance' =>   Alliance::find($request->alliances), 'guilds' => Guild::where('alliance_id', null)->get()]);
    }
}
