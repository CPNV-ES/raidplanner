<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Server;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view('public.welcome');
    }

    public function server_list()
    {
        return view('public.server_list')->with('servers', Server::all());
    }
}
