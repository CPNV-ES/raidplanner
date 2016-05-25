<?php

namespace App\Http\Controllers;

use App\Guild;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Alliance;

class AllianceController extends Controller
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
        $alliance = new Alliance();
        $alliance->name = $request->name;
        $alliance->icon_path = $request->icon_path;
        $alliance->save();
        return redirect()->route('alliances.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alliance = Alliance::find($id);
        return view('alliances.show')->with('alliance',$alliance);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alliance = Alliance::find($id);
        $guilds = Guild::all();
        return view('alliances.edit',compact('alliance','guilds'));
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
        $alliance = Alliance::find($id);

        if (isset($request->name)){
            $alliance->name = $request->name;
        }

        if (isset($request->icon_path)){
            $alliance->icon_path = $request->icon_path;
        }
        $alliance->save();
        return redirect('alliances');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alliance = Alliance::find($id);
        $alliance->delete();
        return redirect()->route('alliances.index');
    }
}
