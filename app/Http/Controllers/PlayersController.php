<?php

namespace App\Http\Controllers;
use HTML;

use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use URL;
use App\Utilities\Ipconfig;


class PlayersController extends Controller
{
    protected $ipconfig;

    public function __construct(Ipconfig $ipconfig){
        $this->ipconfig=$ipconfig;

    }

    public function index(){

        $ipadress_api=$this->ipconfig->ipadress();

        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté la liste des joueurs",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        /* debut script pagination */

        /*fin script pagination */

        /*debut liste de joueurs en provenance le l'api */
        
        $results = Curl::to($ipadress_api.'/admin/gamers')->asJson()->get();
        
        $cmpttotaldata= $results->data->total;
        $cmptconfirmed= $results->data->confirmed;
        $cmptunconfirmed= $results->data->unconfirmed;
        $lists= $results->data->list;

        /* fin liste de joueurs en provenance le l'api */

        return view('admin.players.players',compact(
            'lists',
            'cmpttotaldata',
            'cmptconfirmed',
            'cmptunconfirmed'
            )
        );
    }

    public function indexProfil($id=null){
         $ipadress_api=$this->ipconfig->ipadress();

        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté les détails d'un joueurs",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */


        $results = Curl::to($ipadress_api.'/admin/gamer/'.$id)->asJson()->get();

        //dd($results->data->firstname);
        return view('admin.players.players_profil',compact('results'));
    }

    //Gamers per profiles

    public function indexProfilJDigit($id=null){
     

        $ipadress_api=$this->ipconfig->ipadress();
        $results = Curl::to($ipadress_api.'/admin/gamer/'.$id)->asJson()->get();



        return view('admin.players.details.tickets_jeux_digit',compact('id','results'));
    }

     public function indexProfilLoto($id=null){


        $ipadress_api=$this->ipconfig->ipadress();
        $results = Curl::to($ipadress_api.'/admin/gamer/'.$id)->asJson()->get();
        

        return view('admin.players.details.tickets_loto',compact('id','results'));
    }

    public function indexProfilAlr($id=null){

        $ipadress_api=$this->ipconfig->ipadress();
        $results = Curl::to($ipadress_api.'/admin/gamer/'.$id)->asJson()->get();

        return view('admin.players.details.tickets_pmualr',compact('id','results'));
    }

    public function indexProfilPlr($id=null){

         $ipadress_api=$this->ipconfig->ipadress();
        $results = Curl::to($ipadress_api.'/admin/gamer/'.$id)->asJson()->get();

        return view('admin.players.details.tickets_pmuplr',compact('id','results'));
    }

    public function indexProfilSportcash($id=null){

        $ipadress_api=$this->ipconfig->ipadress();
        $results = Curl::to($ipadress_api.'/admin/gamer/'.$id)->asJson()->get();

        return view('admin.players.details.tickets_sportcash',compact('id','results'));
    }

    
}











