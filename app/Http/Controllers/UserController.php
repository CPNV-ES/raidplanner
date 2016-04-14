<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
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

        $this->sendConfirmationMail($user);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('profile', ['user' => $user, 'error' => ""]);
    }

    /**
     * Display the logged resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLogged()
    {
        return view('profile', ['user' => Auth::user(), 'error' => ""]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        if ($user->id != Auth::user()->id){
            return redirect("profile/$id");
        }

        return view('edit_profile', ['user' => $user]);
    }

    /**
     * Show the form for editing the logged resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editLogged()
    {
        return view('edit_profile', ['user' => Auth::user()]);
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
        if(Auth::getUser()->id == $id)
        {
            $this->validateUpdate($request);

            $error = "";
            $user = User::find($id);
            $user->email = $request->input('email');
            $user->firstname = $request->input('first_name');
            $user->lastname = $request->input('last_name');

            if(!empty($request->input('old_password'))){
                if(Hash::check($request->input('old_password'), $user->password)) {
                    $user->password = Hash::make($request->input('password'));
                }
                else{
                    $error = "Password not changed !";
                }
            }

            $user->save();

            return redirect("profile/$id");
            //return view("profile", ['user' => $user, 'error' => $error]);
        }
        return redirect("home");
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

        return redirect('/');
    }

    /**
     * Validate the user register request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateUpdate(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|alpha_num|min:4|max:16', 'email' => 'required|email',
            'first_name' => 'string|min:3', 'last_name' => 'string|min:3',
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
            'username' => 'required|alpha_num|min:4|max:16', 'email' => 'required|email',
            'password' => 'required|min:3|confirmed', 'password_confirmation' => 'required'
        ]);
    }
}
