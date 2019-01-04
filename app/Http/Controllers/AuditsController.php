<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Models\Logaudits;
use DB;

class AuditsController extends Controller
{
     public function index(){

         /*Debut  Piste d'audits */
         $user = Auth::user();
         $current = new Carbon;
         $currentD=Carbon::parse($current)->format('d/m/Y');
         $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
         $datap=[];
         $datap[]=[
             'utilisateur'=>$user->email,
             'action'=>"a consulté la piste d'audits",
             'type'=>'consultation',
             'dates'=> $currentD, // date de la creation de l'audits
             'heures'=> $currentH,   //formatage heure
         ];
         DB::table('logaudits')->insert($datap);
         /* fin piste d'audits */

         $logaudits = Logaudits::get();
         return view('admin.audits.audits')->with(compact('logaudits'));
     }
}
