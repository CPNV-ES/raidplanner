<?php

namespace App\Http\Controllers;

use App\Alliance;
use App\Guild;
use App\GuildMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;

class GuildsController extends DomainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guilds = Guild::onServer($this->server())->get();
        return view ('guilds.index')->with('guilds', $guilds);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('guilds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $guild = new Guild();
        $guild->name = $request->input('name');
        $guild->icon_path = $request->input('icon_path');
        $guild->server_id = $this->server()->id;
        $guild->save();
        GuildMember::create(['user_id' => Auth::getUser()->id, 'guild_id' => $guild->id, 'role' => 'master']);
        return redirect()->route('guilds.index', $this->server()->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return view ('guilds.show')->with('guild', Guild::find($request->guilds));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showMy()
    {
        $guild = Auth::getUser()->guilds()->onServer($this->server())->first();
        if($guild == null){
            abort('403', "You don't have guild on " + title_case($this->server()->slug));
        }
        return view ('guilds.show')->with('guild', $guild);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return view('guilds.edit')->with('guild', Guild::find($request->guilds));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $guild=Guild::find($request->guilds);
        $guild->name = $request->input('name');
        $guild->icon_path = $request->input('icon_path');
        $guild->save();
        return redirect()->route('guilds.show', [$guild->id, 'subdomain' => $this->server()->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $guild=Guild::find($request->guilds);
        $guild->delete();
        return redirect()->route('guilds.edit_members', $this->server()->slug);
    }
}
