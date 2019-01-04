<?php

namespace App\Http\Controllers;

use App\Models\Profiles;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Models\Permission;
use Carbon\Carbon;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Facades\Gate;


class ProfilController extends Controller
{

    public function add(Request $request )
    {
        if($request->isMethod('POST')){
            $data = $request->all();
            $current = Carbon::now();

            $profil= new Profiles;
            $profil->manager=$data['intitle'];
            $profil->description=$data['departement'];
            $profil->departement=$data['responsable'];
            $profil->created_at=$current;
            $profil->save();
            Flashy::primary('Profil ajouté avec succès', '#');

            return redirect(route('voir_profil'));
        }
        return view('admin.profils.add_profil');
    }

    public function voir(){
        $profils=Profiles::get();
        $profils=json_decode(json_encode($profils));
        return view('admin.profils.voir_profil')->with(compact('profils'));
    }
    public function edit(Request $request, $id=null){
        if($request->isMethod('POST')){
            $data = $request->all();
            $current = Carbon::now();
            Profiles::where(['id'=>$id])->update([
                'manager'=>$data['intitle'],
                'description'=>$data['departement'],
                'departement'=>$data['responsable'],
                'updated_at'=>$current,
            ]);

            Flashy::primary('Profil modifié avec succès', '#');

            return redirect(route('voir_profil'));
        }
        $profilDetails=Profiles::where(['id'=>$id])->first();

        return view('admin.profils.edit_profil',compact('profilDetails'));
    }

    public function delete( $id=null)
    {
        if(!empty($id)){
            Profiles::where(['id'=>$id])->delete();
            Flashy::primary('Profil supprimé avec succès', '#');
            return redirect(route('voir_profil'));
        }

    }

    public function habilitation()
    {
        $perms=Permission::get();
        $perms=json_decode(json_encode($perms));
        return view('admin.habilitations.edit_habilitation')->with(compact('perms'));
    }

}
