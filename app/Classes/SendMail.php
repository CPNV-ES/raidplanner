<?php

namespace App\Classes;

use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Mail;

class SendMail{
    private $url = "raidplanner.dev";
    private $from = ["planner.raid@gmail.com", "Raidplanner.dev"];

    private $validate = "/validate/";
    private $validate_view = "emails/email_confirmation";

    public function sendMail($view, $subject, $args, $to, $from = false){
        if(!$from){
            $from = $this->from;
        }

        Mail::send($view, $args, function ($message) use ($to, $subject, $from){
            $message->to($to)->subject($subject);


            $message->from($from[0], $from[1]);
        });
    }

    public function sendConfirmationMail($user){
        $args = ['username' => $user->username, 'url' => $this->url . $this->validate . $user->id . '/' . $user->remember_token];

        $this->sendMail($this->validate_view, "Confirme your Mail address !", $args, $user->email);
    }
}