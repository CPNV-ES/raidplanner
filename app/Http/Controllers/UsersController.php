<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Validator;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use SendMail;

class UsersController extends DomainController
{
    use AuthenticatesAndRegistersUsers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth/register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateRegister($request);

        $user = User::create(['username' => $request->input('username'), 'email' => $request->input('email'), 'password' => Hash::make($request->input('password'))]);

        $user->remember_token = str_random(40);
        $user->save();

        SendMail::sendConfirmationMail($user);

        return redirect()->route("login");
    }

    /**
     * Display the logged user profile.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::getUser();
        return view('profile.show', ['user' => $user, 'editable' => true, 'guild' => $user->guilds()->onServer($this->server())->first()]);
    }


    /**
     * Show the form for editing the logged resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
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
        $this->validateUpdate($request);

        $error = "";
        $user = Auth::getUser();
        $user->email = $request->input('email');
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');

        if(!empty($request->input('old_password'))){
            if(Hash::check($request->input('old_password'), $user->password)) {
                $user->password = Hash::make($request->input('password'));
            }
            else{
                return redirect()->back()->withInput()->withErrors(['old_password' => "Password is incorrect.."]);
            }
        }

        $user->save();

        return redirect()->route("profile.show", $request->subdomain);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function validateRegisterToken($id, $remember_token){
        $user = User::find($id);

        if(!empty($user)){
            if($user->remember_token == $remember_token){
                $user->valid = true;

                $user->save();
            }
        }

        return redirect()->route("public.welcome");
    }

    /**
     * Validate the profile update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateUpdate(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|alpha_num|min:4|max:16|unique:users', 'email' => 'required|email|unique:users',
            'firstname' => 'string|min:3', 'lastname' => 'string|min:3',
            'old_password' => 'required_with_all:password',
            'password' => 'required_with_all:password_confirmation|min:3|confirmed',
            'password_confirmation' => 'required_with_all:old_password'
        ]);
    }

    /**
     * Validate the user register request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateRegister(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|alpha_num|min:4|max:16|unique:users', 'email' => 'required|email|unique:users',
            'password' => 'required|min:3|confirmed', 'password_confirmation' => 'required'
        ]);
    }
}
