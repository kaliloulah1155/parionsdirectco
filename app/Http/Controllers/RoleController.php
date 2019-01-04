<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use Spatie\Permission\Models\Permission;
use DB;
use Alert;

class RoleController extends Controller
{
 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté la liste des profils",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */
       //Alert::message('Thanks for comment!')->persistent('Close');
      //Alert::success('Good job!')->persistent("Close");
        $roles  = Role::get();
        return view('admin.profils.voir_profil')->with(compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté la création de profil",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        $permission = Permission::get();
        return view('admin.profils.add_profil');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->isMethod('POST')){

            $current = Carbon::now();

            $role = Role::create( [
                'name' => $request->input('name'),
                'departement' => $request->input('departement'),
                'responsable' => $request->input('responsable'),
                'guard_name'=>'web',
                'created_at' =>$current,
                'updated_at' =>$current,
            ]);


            /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a ajouté le profil ".$request->input('name'),
            'type'=>'création',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

           // Flashy::primary('Profil ajouté avec succès', '#');
           Alert::success('Profil ajouté avec succès')->persistent('Fermer');

            return redirect(route('voir_role'));
        }

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // dd('edit');
        $role = Role::find($id);

        return view('admin.profils.edit_profil',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rolep = Role::find($id);
        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté le formulaire de modification du profil ".$rolep->name,
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('admin.profils.edit_profil',compact('role','permission','rolePermissions'));
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


        $this->validate($request, [
            'name' => 'required',

        ]);
        //trouve le profil de l'utilisateur connecté
        $role = Role::find($id);
        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a modifié le profil de ".$role->name." à ".$request->input('name'),
            'type'=>'modification',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        $current = Carbon::now();
        Role::where(['id'=>$id])->update([
            'name'=>$request->input('name'),
            'responsable'=>$request->input('responsable'),
            'departement'=>$request->input('departement'),
            'updated_at'=>$current,
        ]);


        //Flashy::primary('Profil mis à jours avec succès', '#');
        Alert::success('Profil mis à jours avec succès')->persistent('Fermer');

       return redirect(route('voir_role'));

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //trouve le profil de l'utilisateur connecté
        $role = Role::find($id);
        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a supprimé le profil ".$role->name,
            'type'=>'suppression',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        DB::table("roles")->where('id',$id)->delete();
      //  Flashy::primary('Profil supprimé avec succès', '#');
        return redirect()->route('voir_role');
    }

    public function habilitation($id)
    {

        $role = Role::find($id);

        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté les habilitations du profil ".$role->name,
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        $permission=Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        
        return view('admin.habilitations.edit_habilitation')->with(compact('role','permission','rolePermissions'));
    }
    public function valide_habilitation(Request $request, $id){

        $roles=Role::where(['id'=>$id])->first();

        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a modifié les habilitations du profil ".$roles->name,
            'type'=>'modification',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        $roles->syncPermissions($request->input('permission'));

       // Flashy::primary("Habilitation effectué", '#');
        Alert::success('Habilitation effectuée')->persistent('Fermer');
        return redirect(route('voir_role'));
    }


    public function banRoles(Request $request)
    {
       
        $status= $request->status;
        $roleID=$request->roleID;

        $update_status=DB::table('roles')->where('id',$roleID)
            ->update([
                'status'=>$status,
            ]);
        if($update_status){
            echo  $status;
        }
    }
}
