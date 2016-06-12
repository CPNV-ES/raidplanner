<?php

namespace App\Classes;

use Mockery\CountValidator\Exception;

class SendMail{
    private $url = "raidplanner.dev";
    private $form = ["planner.raid@gmail.com", "Raidplanner.dev"];

    private $validate = "/validate/";
    private $validate_view = "emails/mail_confirmation";

    public function sendMail($view, $subject, $args, $to, $form = false){
        if(!$form){
            $form = $this->form;
        }

        Mail::send($view, $args, function ($message) use ($to, $subject, $form){
            $message->to($to)->subject($subject);


            $message->from(form[0], form[1]);
        });
    }

    public function sendConfirmationMail($user){
        $args = ['username' => $user->username, 'url' => $this->url . $this->validate . $user->id . '/' . $user->remember_token];

        sendMail($this->validate_view, "Confirme your Mail address !", $args, $user->email);
    }
}