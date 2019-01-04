<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class ContactMessageCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $titre;
    public $email;
    public $msg;
    //public $file;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$titre,$msg)
    {
        $this->titre=$titre;
        $this->email=$email;
        $this->msg=$msg;
       // $this->file=$file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
       $contentTitre=$request->input('titre');
       $contentFile=$request->file('file');

       dd($this->attachments);
        $pathToFile = 'public/storage/attachment/'.$contentFile;
        $mime = 'image/png';
        $display = 'campaign';
       
      // $message->attach($pathToFile, ['as' => $display, 'mime' => $mime]);

       return $this->subject($contentTitre)->attach($pathToFile, ['as' => $display, 'mime' => $mime])->markdown('emails.messages.createdmail');
      // return $this->subject($contentTitre)->markdown('emails.messages.createdmail');
    }
}
