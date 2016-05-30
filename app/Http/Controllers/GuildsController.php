<?php

namespace App\Http\Controllers;

use App\Alliance;
use App\Guild;
use Illuminate\Http\Request;
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
        $guilds = Guild::all();
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
        $guild->save();
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
        $guild->name = $request->name;
        $guild->icon_path = $request->icon_path;
        $guild->server_id = 1;
        $guild->alliance_id = 1;
        $guild->alliance_role = 1;
        $guild->save();
        return redirect()->route('guilds.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guild = Guild::find($id);
        return view ('guilds.show')->with('guild', $guild);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $guild=Guild::find($id);
        $guild->save();
        return view('guilds.edit',compact('guild'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $guild=Guild::find($id);
        $guild->name = $request->name;
        $guild->icon_path = $request->icon_path;
        $guild->save();
        return redirect('guilds');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guild=Guild::find($id);
        $guild->delete();
        return redirect()->route('guilds.index');
    }
}
