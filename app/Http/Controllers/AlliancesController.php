<?php

namespace App\Http\Controllers;

use App\Guild;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Alliance;
use Illuminate\Support\Facades\Auth;
use Role;

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

        //TO_DO : si il peut créer une alliance, envoyer une variable à true afin de juste vérifier dans la vue si elle est true ou pas
        return view('alliances.index', ['alliances' => $alliances]);
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
        $guild =  Auth::getUser()->guilds()->onServer($this->server())->first();
        $currentUser = Auth::getUser();
        $user = ($guild->usersByRole('master')->first());

         //FIX TO: ça marche de cette façon mais ce n'est pas la meilleure. En effet, la façon dont notre base de donnée est conçue, elle autorise plusieurs guild master par guilde alors qu'il ne peut en avoir que un
        if($user->id == $currentUser->id && $guild->alliance()==null){
            $alliance = new Alliance();
            $alliance->name = $request->input('name');
            $alliance->icon_path = $request->input('icon_path');
            $alliance->save();
            $guild->alliance()->associate($alliance);
            $guild->alliance_role = 'master';
            $guild->save();
            return redirect()->route('alliances.show',  [$alliance->id, 'subdomain' => $request->subdomain]);
        }else{
            abort('403',"you don't have a guild or your guild already has an alliance");
        }
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
        $alliance = Auth::getUser()->guilds()->onServer($this->server())->first()->alliance;
        if ($alliance == null) {
            return view('alliances.index')->with('alliances',Alliance::all());
        } else {
            return view('alliances.show')->with('alliance', $alliance);
        }
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

    private function validateAuthenticate($forwhat){
        if(Role::haveRoleFor('alliances.' . $forwhat, Auth::getUser(), false)) {
            return true;
        }
    }
}
