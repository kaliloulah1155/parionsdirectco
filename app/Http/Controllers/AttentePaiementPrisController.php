<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use Ixudra\Curl\Facades\Curl;
use App\Utilities\Ipconfig;

class AttentePaiementPrisController extends Controller
{
    protected $ipconfig;

    public function __construct(Ipconfig $ipconfig){
        $this->ipconfig=$ipconfig;

    }

    public function indexPaiementVal(){

        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté la liste des paiements validés(Paiement en attente)",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        return view('admin.attentepaiement.paiementvalide');
    }

    public function indexLotoBonheur(){
        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté la liste du Loto Bonheur(Paiement en attente)",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */
         
         $ipadress_api=$this->ipconfig->ipadress();

         $results = Curl::to($ipadress_api.'/admin/ail/loto/waiting_payments')->asJson()->get();

         

        return view('admin.attentepaiement.lotobonheur');
    }

    public function indexPmuAlr(){

        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté la liste du PMU ALR(Paiement en attente)",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        $ipadress_api=$this->ipconfig->ipadress();

        $results = Curl::to($ipadress_api.'/admin/alr/waiting_payments')->asJson()->get();

        return view('admin.attentepaiement.pmualr');
    }

    public function indexPmuPlr(){

        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté la liste du PMU PLR(Paiement en attente)",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        $ipadress_api=$this->ipconfig->ipadress();

        $results = Curl::to($ipadress_api.'/admin/ail/pmu/waiting_payments')->asJson()->get();
        return view('admin.attentepaiement.pmuplr');
    }

    public function indexSportcash(){

        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté la liste du jeu SPORTCASH(Paiement en attente)",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */
        $ipadress_api=$this->ipconfig->ipadress();

        $results = Curl::to($ipadress_api.'/admin/sportcash/waiting_payments')->asJson()->get();
        
        return view('admin.attentepaiement.sportcash');
    }
}
