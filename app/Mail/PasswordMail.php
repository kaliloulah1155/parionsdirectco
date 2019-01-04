<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\PasswordController;
use Illuminate\Http\Request;

class PasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email_msg;
    public $msg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$email_msg,$msg)
    {
        $this->name=$name;
        $this->email=$email_msg;
        $this->msg=$msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        $email_msg = $request->input('email_msg');
        return $this->markdown('emails.messages.created')->with([
            'email'=>$email_msg,
        ]);
    }
}
