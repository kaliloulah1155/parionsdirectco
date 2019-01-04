<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\PasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use MercurySeries\Flashy\Flashy;
use App\User;
use Alert;

class PasswordController extends Controller
{
	//use ResetsPasswords;

    public function emailpassword(Request $request)
    {
       
    	$email = $request->input('email_msg');

      $user=User::whereEmail($email)->first();
    
      if(!$user){
           return redirect('/login')->with('flash_message_error',"Erreur à la saisie de l'email");
      }else{
        $maillable= new PasswordMail('Administrateur',$email,'Bienvenue sur le backoffice');

         Mail::to($email)->send($maillable);
          
        Alert::success('E-mail de réinitialisation envoyé')->persistent('Fermer');
         
         return redirect('/login');
      }

    }

    public function passwordForm(Request $request)
    {

        $mdp = $request->input('password');
        $mdpconf = $request->input('password_confirmation');
        $email = $request->input('email');
           if(!empty($mdp) AND !empty($mdpconf)){
            
              if($mdp===$mdpconf){
                  
                  $user=User::whereEmail($email)->firstOrFail();
                  $user->password=Hash::make($mdp);
                $user->update();
                //Flashy::primaryDark('Mot de passe réinitialisé avec succès', '#');
                Alert::success('Mot de passe réinitialisé avec succès')->persistent('Fermer');
                return redirect('/login')->with('flash_message_error',"Mot de passe réinitialisé avec succès");
                }else{
                  Alert::success('Mot de passe non identique')->persistent('Fermer');
                return redirect('/admin/password/reset');
             }
           }
    	 return view('admin/reset');
    }
}
