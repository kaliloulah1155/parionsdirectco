<?php

namespace App\Utilities;
use Auth;
use App\User;
use App\Models\Smsmessages;
use App\Models\Smstext;
use Spatie\Permission\Models\Role;

class Authinfos{

    public function isFirstname(){
        $user = Auth::user();
        return $firstname=$user->firstname;
    }
    public function isLastname(){
        $user = Auth::user();
        return $lastname=$user->lastname;
    }

    public function isUserId(){
        $user = Auth::user();
        $roles=$user->roles->pluck('name');
        return $roles;
    }

    public function isUserIdP(){
        $user = Auth::user();
        return $userid=$user->id;
    }

    public function isCountSMS(){
        $sms = Smstext::all();
        return $countsms=$sms->count();
    }

     public function isCountEMAIL(){
        $email = Smsmessages::all();
        return $countemail=$email->count();
    }

    public function isCountUSERS(){
        $userC = User::all();
        return $countusers=$userC->count();
    }

    public function isCountRole(){
        $roleC = Role::all();
        return $countrole=$roleC->count();
    }

}
