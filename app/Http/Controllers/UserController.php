<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Auth;
use MercurySeries\Flashy\Flashy;
use Spatie\Permission\Models\Role;
use Hash;
use DB;
use Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   function __construct()
    {


    }

    public function add( Request $request )
    {
        /*Debut  Piste d'audits **/
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté la création des utilisateurs",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */


        if($request->isMethod('POST')){
            $userpassword=$request->input('mdp');
            $usermdpconf=$request->input('mdpconf');
           


            $data=[];
            $data[]=[
                'firstname'=>$request->input('firstname'),
                'lastname'=>$request->input('lastname'),
                'phone_number'=>$request->input('telephone'),
                'email'=>$request->input('email'),
                'password'=> Hash::make($request->input('mdp')),
                'created_at'=>Carbon::now()

            ];

            $email = $request->input('email');
            $usermail=User::whereEmail($email)->first();

            if($usermail){
                // Flashy::error('Ce Compte existe', '#');
                 Alert::error('Ce Compte existe')->persistent('Fermer');
            }else{

                 if($usermdpconf==$userpassword){

                    DB::table('users')->insert($data);
                    //Flashy::primary('Utilisateur ajouté avec succès', '#');
                     Alert::success('Utilisateur ajouté avec succès')->persistent('Fermer');
                
                    /*Debut  Piste d'audits */
                    $user = Auth::user();
                    $current = new Carbon;
                    $currentD=Carbon::parse($current)->format('d/m/Y');
                    $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
                    $datap=[];
                    $datap[]=[
                        'utilisateur'=>$user->email,
                        'action'=>"a ajouté l'utilisateur ".$request->input('email'),
                        'type'=>'création',
                        'dates'=> $currentD, // date de la creation de l'audits
                        'heures'=> $currentH,   //formatage heure
                    ];
                    DB::table('logaudits')->insert($datap);
                    /* fin piste d'audits */

                    /** attribution de droit **/

               $userrqE=User::whereEmail($email)->get()->first();
               $userrqI=$userrqE->id;
               $userrq = User::find($userrqI);

                if(!empty($userrq)){
                        
                        $userrq->assignRole($request->get('roles'));

                        /*Debut  Piste d'audits */
                        $userd = Auth::user();
                        $current = new Carbon;
                        $currentD=Carbon::parse($current)->format('d/m/Y');
                        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
                        $datap=[];
                        $datap[]=[
                            'utilisateur'=>$userd->email,
                            'action'=>"a attribué le profil ".$userrq->roles->pluck('name')." à l'utilisateur ".$userrq->email,
                            'type'=>'habilitation',
                            'dates'=> $currentD, // date de la creation de l'audits
                            'heures'=> $currentH,   //formatage heure
                        ];
                        DB::table('logaudits')->insert($datap);
                        /* fin piste d'audits */
                 }


                    return redirect(route('voir_user'));
                 }else{
                   // Flashy::error('Mot de passe incorrect', '#');
                     Alert::error('Mot de passe incorrect')->persistent('Fermer');

                 }
           
            }

        }
        //recupération du profil si 0 activé si 1 desactivé
        $roles = Role::where('status',0)->pluck('name','name');
        return view('admin.utilisateurs.add_user',compact('roles'));
    }

    public function voir(Request $request){

        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté la liste des utilisateurs",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        $data = User::all()->sortBy('id');
        return view('admin.utilisateurs.voir_user')->with(compact('data'));
    }

    public function edit(Request $request, $id=null){
        $userp=User::find($id);
        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté le formulaire de modification de l'utilisateur ".$userp->email,
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        if($request->isMethod('POST')){
            DB::table('users')->where('id',$id)->update([
                'firstname'=>$request->input('firstname'),
                'lastname'=>$request->input('lastname'),
                'phone_number'=>$request->input('telephone'),
                'email'=>$request->input('email'),
                'updated_at'=>Carbon::now()
            ]);

            $user=User::find($id);
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $user->assignRole($request->input('roles'));

            /*Debut  Piste d'audits */
            $user = Auth::user();
            $current = new Carbon;
            $currentD=Carbon::parse($current)->format('d/m/Y');
            $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
            $datap=[];
            $datap[]=[
                'utilisateur'=>$user->email,
                'action'=>"a modifié l'utilisateur ".$request->input('email'),
                'type'=>'modification',
                'dates'=> $currentD, // date de la creation de l'audits
                'heures'=> $currentH,   //formatage heure
            ];
            DB::table('logaudits')->insert($datap);
            /* fin piste d'audits */

           // Flashy::primary('Utilisateur modifié avec succès', '#');
            Alert::success('Utilisateur modifié avec succès')->persistent('Fermer');

            return redirect(route('voir_user'));
        }
        $userDetails=User::where(['id'=>$id])->first();

       //recupération du profil si 0 activé si 1 desactivé
        $roles = Role::where('status',0)->pluck('name','name');

        return view('admin.utilisateurs.edit_user',compact('userDetails','roles'));
    }

    public function delete( $id=null)
    {
        if(!empty($id)){
            $userp=User::find($id);
            /*Debut  Piste d'audits */
            $user = Auth::user();
            $current = new Carbon;
            $currentD=Carbon::parse($current)->format('d/m/Y');
            $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
            $datap=[];
            $datap[]=[
                'utilisateur'=>$user->email,
                'action'=>"a supprimé l'utilisateur ".$userp->email,
                'type'=>'suppression',
                'dates'=> $currentD, // date de la creation de l'audits
                'heures'=> $currentH,   //formatage heure
            ];
            DB::table('logaudits')->insert($datap);
            /* fin piste d'audits */

            User::where(['id'=>$id])->delete();
           // Flashy::primary('Utilisateur supprimé avec succès', '#');
            return redirect(route('voir_user'));
        }

    }

    public function detail($id=null){
        $userDetails=User::find($id);

        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a observé les infos sur ".$userDetails->email,
            'type'=>'information',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        return view('admin.utilisateurs.detail_user',compact('userDetails'));
    }

}
