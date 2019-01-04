<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use MercurySeries\Flashy\Flashy;
use DB;
use Auth;

class DroitController extends Controller
{
    public function add( Request $request )
    {
        /*Debut  Piste d'audits ****/
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté la gestion des droits",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        if($request->isMethod('POST')){
            $user = User::find($request->get('users'));
            if(!empty($user)){
                DB::table('model_has_roles')->where('model_id',$user->id)->delete();
                $user->assignRole($request->get('roles'));

                /*Debut  Piste d'audits */
                $userd = Auth::user();
                $current = new Carbon;
                $currentD=Carbon::parse($current)->format('d/m/Y');
                $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
                $datap=[];
                $datap[]=[
                    'utilisateur'=>$userd->email,
                    'action'=>"a attribué le profil ".$user->roles->pluck('name')." à l'utilisateur ".$user->email,
                    'type'=>'habilitation',
                    'dates'=> $currentD, // date de la creation de l'audits
                    'heures'=> $currentH,   //formatage heure
                ];
                DB::table('logaudits')->insert($datap);
                /* fin piste d'audits */
                Flashy::primary('Vous avez assigné un droit', '#');
            }
            
        }

        //recupération du profil si 0 activé si 1 desactivé
        $roles = Role::where('status',0)->pluck('name','name');

        $users=User::get();
        return view('admin.droits.add_droits',compact('roles','users'));
    }
}
