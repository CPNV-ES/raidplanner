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
    public function show(Request $request)
    {
        return view('alliances.show')->with('alliance', Alliance::find($request->alliances));
    }
    
    public function showMy()
    {
        //dd(Auth::getUser()->guilds()->onServer($this->server())->get());
        $alliance = Auth::getUser()->guilds()->onServer($this->server())->firstOrFail()->alliance;
        return view('alliances.show')->with('alliance', $alliance);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $alliance = Alliance::find($request->alliances);
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
    public function update(Request $request)
    {
        $alliance = Alliance::find($request->alliances);

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
    public function destroy(Request $request)
    {
        $alliance = Alliance::find($request->alliances);
        $alliance->delete();
        return redirect()->route('alliances.index', $request->subdomain);
    }

    /**
     * Validate the user register request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateCreateAlliances(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|alpha_num|min:3|max:16',
            'icon' => 'required|min:5'
        ]);
    }
}
