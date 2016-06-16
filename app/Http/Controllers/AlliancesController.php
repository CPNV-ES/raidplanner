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
        $canCreate = false;
        $alliances = Alliance::all();
        $guild = Auth::getUser()->guilds()->onServer($this->server())->first();

        if ($guild != null) {
            $currentUser = Auth::getUser();
            $user = ($guild->usersByRole('master')->first());
            if ($user->id == $currentUser->id && $guild->alliance() == null) {
                $canCreate = true;
            }
        }

        //FIX TO: ça marche de cette façon mais ce n'est pas la meilleure. En effet, la façon dont notre base de donnée est conçue, elle autorise plusieurs guild master par guilde alors qu'il ne peut en avoir que un
        return view('alliances.index', ['alliances' => $alliances, 'canCreate' => $canCreate]);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $guild = Auth::getUser()->guilds()->onServer($this->server())->first();
        $currentUser = Auth::getUser();
        $user = ($guild->usersByRole('master')->first());

        //FIX TO: ça marche de cette façon mais ce n'est pas la meilleure. En effet, la façon dont notre base de donnée est conçue, elle autorise plusieurs guild master par guilde alors qu'il ne peut en avoir que un
        if ($user->id == $currentUser->id && $guild->alliance() == null) {
            $alliance = new Alliance();
            $alliance->name = $request->input('name');
            $alliance->icon_path = $request->input('icon_path');
            $alliance->save();
            $guild->alliance()->associate($alliance);
            $guild->alliance_role = 'master';
            $guild->save();
            return redirect()->route('alliances.show', [$alliance->id, 'subdomain' => $request->subdomain]);
        } else {
            abort('403', "you don't have a guild or your guild already has an alliance");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $alliance = Alliance::find($request->alliances);
        $canEdit = $this->validateAuthenticate('edit',$alliance );
        $canDelete = $this->validateAuthenticate('destroy', $alliance);
        $canQuit = $this->validateAuthenticate('quit', $alliance);
        $canEditMembers = $this->validateAuthenticate('members.edit', $alliance);

        return view('alliances.show', ['alliance' => Alliance::find($request->alliances), 'canEdit' => $canEdit, 'canDelete' => $canDelete, 'canQuit' => $canQuit, 'canEditMembers' => $canEditMembers]);
    }

    public function showMy()
    {
        if (Auth::getUser()->guild == null) {
            abort('403', "You aren't in a guild");
        } else {
            $alliance = Auth::getUser()->guilds()->onServer($this->server())->first()->alliance;
            $canCreate = $this->validateAuthenticate('create', false);
            $canEdit = $this->validateAuthenticate('edit', $alliance);
            $canDelete = $this->validateAuthenticate('destroy', $alliance);
            $canQuit = $this->validateAuthenticate('quit', $alliance);
            $canEditMembers = $this->validateAuthenticate('members.edit', $alliance);

            if ($alliance == null) {
                return view('alliances.index', ['alliances' => Alliance::all(), 'canCreate' => $canCreate]);
            } else {
                return view('alliances.show', ['alliance' => $alliance, 'canEdit' => $canEdit, 'canDelete' => $canDelete, 'canQuit' => $canQuit, 'canEditMembers' => $canEditMembers]);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $alliance = Alliance::find($request->alliances);
        return view('alliances.edit',['alliance' => $alliance]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $alliance = Alliance::find($request->alliances);

        if (!empty($request->input('name'))) {
            $alliance->name = $request->input('name');
        }

        if (!empty($request->input('icon_path'))) {
            $alliance->icon_path = $request->input('icon_path');
        }

        $alliance->save();
        return redirect()->route('alliances.show', [$alliance->id, 'subdomain' => $request->subdomain]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
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
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    protected function validateCreateAlliances(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|alpha_num|min:3|max:16',
            'icon' => 'required|min:5'
        ]);
    }

    protected function validateAuthenticate($forwhat, $rightOn)
    {
        if (Role::haveRoleFor('alliances.' . $forwhat, Auth::getUser(), $rightOn)) {
            return true;
        } else {
            return false;
        }
    }

    public function quit(Request $request)
    {
        $alliance = Alliance::find($request->alliances);
        $guild = Auth::getUser()->guilds()->onServer($this->server())->first();
        if ($guild->alliance_role != 'master') {
            $guild->alliance_id = null;
            $guild->alliance_role = null;
        } else {
            abort('403', 'You are the master of the alliance, you can\'t leave the alliance');
        }
        return redirect()->route('alliance.show', [$alliance->id, 'subdomain' => $this->server()->slug]);
    }

}
