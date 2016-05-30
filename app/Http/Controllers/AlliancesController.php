<?php

namespace App\Http\Controllers;

use App\Guild;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Alliance;
use Illuminate\Support\Facades\Auth;

class AlliancesController extends DomainController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alliances = Alliance::all();
        return view('alliances.index')->with('alliances',$alliances);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alliances.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $guild =  Auth::getUser()->guilds()->onServer($this->server())->firstOrFail();
        $alliance = new Alliance();
        $alliance->name = $request->name;
        $alliance->icon_path = $request->icon_path;
        $alliance->save();
        $guild->alliance()->associate($alliance);
        $guild->alliance_role = 'master';
        $guild->save();
        return redirect()->route('alliances.index', $request->subdomain);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Alliance $alliance)
    {
        return view('alliances.show')->with('alliance', $alliance->get()[0]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Alliance $alliance)
    {
        $alliance = $alliance->get()[0];
        $guilds = $alliance->guilds;
        return view('alliances.edit',compact('alliance','guilds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alliance $alliance)
    {
        $alliance = $alliance->get()[0];

        if (!empty($request->input('name'))){
            $alliance->name = $request->input('name');
        }

        if (!empty($request->input('icon_path'))){
            $alliance->icon_path = $request->input('icon_path');
        }
        $alliance->save();
        return redirect()->route('alliances.show', [$alliance->id, 'subdomain' => $request->subdomain]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Alliance $alliance)
    {
        dd($alliance);
        $alliance->delete();
        return redirect()->route('alliances.index', $request->subdomain);
    }
}
