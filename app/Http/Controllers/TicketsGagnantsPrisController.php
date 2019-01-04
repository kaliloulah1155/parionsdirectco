<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use Carbon\Carbon;
use Ixudra\Curl\Facades\Curl;
use App\Utilities\Ipconfig;

class TicketsGagnantsPrisController extends Controller
{
    protected $ipconfig;

    public function __construct(Ipconfig $ipconfig){
        $this->ipconfig=$ipconfig;

    }

    public function indexGagnantsJeux(){

        $ipadress_api=$this->ipconfig->ipadress();

        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté la liste des gagnants de jeux(Tickets gagnants)",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */
       
       /*loto*/
       $results1 = Curl::to($ipadress_api.'/admin/ail/loto/winnings')->asJson()->get();
       $lotos=$results1->data;

       /*alr*/
       $results2 = Curl::to($ipadress_api.'/admin/alr/winnings')->asJson()->get();
       $alrs=$results2->data;

       /*plr*/
       $results3 = Curl::to($ipadress_api.'/admin/ail/pmu/winnings')->asJson()->get();
       $plrs=$results3->data;

       /*sportcash*/
       $results4 = Curl::to($ipadress_api.'/admin/sportcash/winnings')->asJson()->get();
       $sportcashs=$results4->data;
        

        return view('admin.ticketsgagnants.gagnantsjeux',compact(
            'lotos',
            'alrs',
            'plrs',
            'sportcashs'
        ));

    }
    public function indexLotoBonheur(){
        
        $ipadress_api=$this->ipconfig->ipadress();
        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté la liste des gagnants de jeu Loto Bonheur(Tickets gagnants)",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */


        $results = Curl::to($ipadress_api.'/admin/ail/loto/winnings')->asJson()->get();
        $lists=$results->data;
        return view('admin.ticketsgagnants.lotobonheur',compact('lists'));
    }
    public function indexPmuAlr(){
        $ipadress_api=$this->ipconfig->ipadress();
        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté la liste des gagnants de jeu PMU ALR(Tickets gagnants)",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        $results = Curl::to($ipadress_api.'/admin/alr/winnings')->asJson()->get();
        $lists=$results->data;
        return view('admin.ticketsgagnants.pmualr',compact('lists'));
    }
    public function indexPmuPlr(){
        $ipadress_api=$this->ipconfig->ipadress();
        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté la liste des gagnants de jeu PMU PLR(Tickets gagnants)",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        $results = Curl::to($ipadress_api.'/admin/ail/pmu/winnings')->asJson()->get();
        $lists=$results->data;

        return view('admin.ticketsgagnants.pmuplr',compact('lists'));
    }
    public function indexSportcash(){
        $ipadress_api=$this->ipconfig->ipadress();
        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté la liste des gagnants de jeu SPORTCASH(Tickets gagnants)",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        $results = Curl::to( $ipadress_api.'/admin/sportcash/winnings')->asJson()->get();
        $lists=$results->data;

        return view('admin.ticketsgagnants.sportcash',compact('lists'));
    }

    public function indexInfosgagnant(){

        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté les détails d'un joueur(Tickets gagnants)",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        return view('admin.ticketsgagnants.infos_gagnant');
    }
}
