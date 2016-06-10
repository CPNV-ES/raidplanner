<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;
use Auth;
use View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function sendConfirmationMail($user){
        $user->remember_token = str_random(40);
        $user->save();

        $url = 'raidplanner.dev/validate/'.$user->id.'/'.$user->remember_token;
        Mail::send('emails/password_confirmation', ['username' => $user->username, 'url' => $url], function ($message) use ($user){
            $message->to($user->email)->subject('Test');

            $message->from('planner.raid@gmail.com', 'Raidplanner');
        });
    }
}
