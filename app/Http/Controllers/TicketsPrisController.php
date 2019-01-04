<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use Carbon\Carbon;
use Ixudra\Curl\Facades\Curl;
use App\Utilities\Ipconfig;
use MercurySeries\Flashy\Flashy;
use Alert;

class TicketsPrisController extends Controller
{
    protected $ipconfig;

    public function __construct(Ipconfig $ipconfig){
        $this->ipconfig=$ipconfig;

    }

    public function indexJeuxDigitaux(Request $request){
        $ipadress_api=$this->ipconfig->ipadress();
        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté la liste des jeux digitaux(Tickets pris)",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits 
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        $results = Curl::to($ipadress_api.'/admin/eppl/stats')->asJson()->get();
        
        $encours=$results->data->processing->total;
        $rembourser=$results->data->refund->total;
        $annuler=$results->data->canceled->total;
        $montantannuler=$results->data->canceled->canceled_amount;
        $perdu=$results->data->lost->total;
        $montantperdu=$results->data->lost->amount;
        $gagnant=$results->data->winning->total;
        $montantgagnant=$results->data->winning->amount;
        $montantdugagnant=$results->data->winning->win_amount;


        $responseData = Curl::to($ipadress_api.'/admin/eppl/list')->asJson()->post();
        $listDatEppl=$responseData->data;
       
        if ($request->isMethod('post')) {

          $rq_statut=$request->get('rq_statut');
          $rq_dt_debut=$request->get('rq_dt_debut');
          $rq_dt_fin=$request->get('rq_dt_fin');
          $rq_min_mnt=$request->get('rq_min_mnt');
          $rq_max_mnt=$request->get('rq_max_mnt');


          $rq_dt_debut = str_replace('/', '-', $rq_dt_debut);
          $rq_dt_fin = str_replace('/', '-', $rq_dt_fin);
           

              $response_eppl = Curl::to($ipadress_api.'/admin/eppl/list')
                ->withData([
                    'status'=> $rq_statut,
                    'from'=>$rq_dt_debut,
                    'to'=>$rq_dt_fin,
                    'min_amount'=>$rq_min_mnt,
                    'max_amount'=>$rq_max_mnt
                ])
                ->asJson()
                ->post();

               $response_eppl_data=$response_eppl->data;  
              // Flashy::primary('Recherche effectuée', '#');
               Alert::success('Recherche effectuée')->persistent('Fermer');

         }

         return view('admin.ticketspris.jeuxdigitaux',compact(
            'encours',
            'rembourser',
            'annuler',
            'montantannuler',
            'perdu',
            'montantperdu',
            'gagnant',
            'montantgagnant',
            'montantdugagnant',
            'listDatEppl',
            'response_eppl_data'
        ));
    }
    public function indexLotoBonheur( Request $request){
       
        $ipadress_api=$this->ipconfig->ipadress();
        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté la liste du jeu Loto Bonheur(Tickets pris)",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        $resultats = Curl::to($ipadress_api.'/admin/ail/loto/stats')->asJson()->get();

        $listData=$resultats->data;
        
        $encours=$listData->processing->total;
        $rembourser = $listData->refund->total;
        $mntrembourser = $listData->refund->amount;
        $annuler= $listData->canceled->total;
        $mntannuler= $listData->canceled->canceled_amount;
        $perdant=$listData->lost->total;
        $mntperdant=$listData->lost->amount;
        $gagnant=$listData->winning->total;
        $mntgagnant=$listData->winning->amount;
        $Tmntgagnant=$listData->winning->win_amount;


      //  $responseData = Curl::to($ipadress_api.'/admin/ail/loto/list')->asJson()->post();
      $responseData = Curl::to($ipadress_api.'/admin/ail/loto/payments/')->asJson()->post();
        $listDatLoto=$responseData->data;


        if ($request->isMethod('post')) {

          $rq_statut=$request->get('rq_statut');
          $rq_dt_debut=$request->get('rq_dt_debut');
          $rq_dt_fin=$request->get('rq_dt_fin');
          $rq_min_mnt=$request->get('rq_min_mnt');
          $rq_max_mnt=$request->get('rq_max_mnt');


          $rq_dt_debut = str_replace('/', '-', $rq_dt_debut);
          $rq_dt_fin = str_replace('/', '-', $rq_dt_fin);
           

              $response_loto = Curl::to($ipadress_api.'/admin/ail/loto/list')
                ->withData([
                    'status'=> $rq_statut,
                    'from'=>$rq_dt_debut,
                    'to'=>$rq_dt_fin,
                    'min_amount'=>$rq_min_mnt,
                    'max_amount'=>$rq_max_mnt
                ])
                ->asJson()
                ->post();

               $response_loto_data=$response_loto->data;  
               Alert::success('Recherche effectuée')->persistent('Fermer');
         }
        
        
       return view('admin.ticketspris.lotobonheur',compact(
            'encours',
            'rembourser',
            'mntrembourser',
            'annuler',
            'mntannuler',
            'perdant',
            'mntperdant',
            'gagnant',
            'mntgagnant',
            'Tmntgagnant',
            'listDatLoto',
            'response_loto_data'

        ));
    }
    public function indexPmuAlr( Request $request){
        $ipadress_api=$this->ipconfig->ipadress();
        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté la liste de PMU ALR(Tickets pris)",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        $resultats = Curl::to($ipadress_api.'/admin/alr/stats')->asJson()->get();

        $listData=$resultats->data;
        
        $encours=$listData->processing->total;
        $rembourser = $listData->refund->total;
       // $mntrembourser = $listData->refund->amount;
        $annuler= $listData->canceled->total;
        $mntannuler= $listData->canceled->canceled_amount;
        $perdant=$listData->lost->total;
        $mntperdant=$listData->lost->amount;
        $gagnant=$listData->winning->total;
        $mntgagnant=$listData->winning->amount;
        $Tmntgagnant=$listData->winning->win_amount;


        $responseData = Curl::to($ipadress_api.'/admin/alr/list')->asJson()->post();
        $listDatAlr=$responseData->data;


        if ($request->isMethod('post')) {

          $rq_statut=$request->get('rq_statut');
          $rq_dt_debut=$request->get('rq_dt_debut');
          $rq_dt_fin=$request->get('rq_dt_fin');
          $rq_min_mnt=$request->get('rq_min_mnt');
          $rq_max_mnt=$request->get('rq_max_mnt');


          $rq_dt_debut = str_replace('/', '-', $rq_dt_debut);
          $rq_dt_fin = str_replace('/', '-', $rq_dt_fin);

              $response_alr = Curl::to($ipadress_api.'/admin/alr/list')
                ->withData([
                    'status'=> $rq_statut,
                    'from'=>$rq_dt_debut,
                    'to'=>$rq_dt_fin,
                    'min_amount'=>$rq_min_mnt,
                    'max_amount'=>$rq_max_mnt
                ])
                ->asJson()
                ->post();

               $response_alr_data=$response_alr->data;  
               Alert::success('Recherche effectuée')->persistent('Fermer');

         }

        


        return view('admin.ticketspris.pmualr',compact(
            'encours',
            'rembourser',
           // 'mntrembourser',
            'annuler',
            'mntannuler',
            'perdant',
            'mntperdant',
            'gagnant',
            'mntgagnant',
            'Tmntgagnant',
            'listDatAlr',
            'response_alr_data'
        ));
    }
    public function indexPmuPlr( Request $request){
        $ipadress_api=$this->ipconfig->ipadress();
        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté la liste de PMU PLR(Tickets pris)",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        $resultats = Curl::to($ipadress_api.'/admin/ail/loto/stats')->asJson()->get();
        $listData=$resultats->data;
        
        $encours=$listData->processing->total;
        $rembourser = $listData->refund->total;
        $mntrembourser = $listData->refund->amount;
        $annuler= $listData->canceled->total;
        $mntannuler= $listData->canceled->canceled_amount;
        $perdant=$listData->lost->total;
        $mntperdant=$listData->lost->amount;
        $gagnant=$listData->winning->total;
        $mntgagnant=$listData->winning->amount;
        $Tmntgagnant=$listData->winning->win_amount;

        $responseData = Curl::to($ipadress_api.'/admin/ail/pmu/list')->asJson()->post();
        $listDatPlr=$responseData->data;


        if ($request->isMethod('post')) {

          $rq_statut=$request->get('rq_statut');
          $rq_dt_debut=$request->get('rq_dt_debut');
          $rq_dt_fin=$request->get('rq_dt_fin');
          $rq_min_mnt=$request->get('rq_min_mnt');
          $rq_max_mnt=$request->get('rq_max_mnt');


          $rq_dt_debut = str_replace('/', '-', $rq_dt_debut);
          $rq_dt_fin = str_replace('/', '-', $rq_dt_fin);

              $response_plr = Curl::to($ipadress_api.'/admin/ail/pmu/list')
                ->withData([
                    'status'=> $rq_statut,
                    'from'=>$rq_dt_debut,
                    'to'=>$rq_dt_fin,
                    'min_amount'=>$rq_min_mnt,
                    'max_amount'=>$rq_max_mnt
                ])
                ->asJson()
                ->post();

               $response_plr_data=$response_plr->data;  
              Alert::success('Recherche effectuée')->persistent('Fermer');

         }

        return view('admin.ticketspris.pmuplr',compact(
            'encours',
            'rembourser',
            'mntrembourser',
            'annuler',
            'mntannuler',
            'perdant',
            'mntperdant',
            'gagnant',
            'mntgagnant',
            'Tmntgagnant',
            'listDatPlr',
            'response_plr_data'
        ));
    }

    public function indexSportcash(Request $request){

        $ipadress_api=$this->ipconfig->ipadress();
        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté la liste du jeu SportCash(Tickets pris)",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

       $resultats = Curl::to($ipadress_api.'/admin/sportcash/stats')->asJson()->get();
       $listData=$resultats->data;

        $encours=$listData->processing->total;
        $rembourser = $listData->refund->total;
       // $mntrembourser = $listData->refund->amount;
        $annuler= $listData->canceled->total;
        $mntannuler= $listData->canceled->canceled_amount;
        $perdant=$listData->lost->total;
        $mntperdant=$listData->lost->amount;
        $gagnant=$listData->winning->total;
        $mntgagnant=$listData->winning->amount;
        $Tmntgagnant=$listData->winning->win_amount;


        $responseData = Curl::to($ipadress_api.'/admin/sportcash/list')->asJson()->post();
        $listDatSportcash=$responseData->data;


        if ($request->isMethod('post')) {

          $rq_statut=$request->get('rq_statut');
          $rq_dt_debut=$request->get('rq_dt_debut');
          $rq_dt_fin=$request->get('rq_dt_fin');
          $rq_min_mnt=$request->get('rq_min_mnt');
          $rq_max_mnt=$request->get('rq_max_mnt');


          $rq_dt_debut = str_replace('/', '-', $rq_dt_debut);
          $rq_dt_fin = str_replace('/', '-', $rq_dt_fin);

           
              $response_sportcash = Curl::to($ipadress_api.'/admin/sportcash/list')
                ->withData([
                    'status'=> $rq_statut,
                    'from'=>$rq_dt_debut,
                    'to'=>$rq_dt_fin,
                    'min_amount'=>$rq_min_mnt,
                    'max_amount'=>$rq_max_mnt
                ])
                ->asJson()
                ->post();

               $response_sportcash_data=$response_sportcash->data;  
               Alert::success('Recherche effectuée')->persistent('Fermer');

         }

        return view('admin.ticketspris.sportcash',compact(
            'encours',
            'rembourser',
           // 'mntrembourser',
            'annuler',
            'mntannuler',
            'perdant',
            'mntperdant',
            'gagnant',
            'mntgagnant',
            'Tmntgagnant',
            'listDatSportcash',
            'response_sportcash_data'
        ));
    }


    /**  DETAILS DES JEUX **/

    public function detailsLotoBonheur($id=null){
         $ipadress_api=$this->ipconfig->ipadress();
        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté un détails du jeu Loto Bonheur(Tickets pris)",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        $results = Curl::to($ipadress_api.'/admin/ail/loto/'.$id)->asJson()->get();
        return view('admin.ticketspris.details.detailsloto',compact('results'));

    }

     public function detailsPmuPlr($id=null){
        $ipadress_api=$this->ipconfig->ipadress();
        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté un détails du jeu PLR(Tickets pris)",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        $results = Curl::to($ipadress_api.'/admin/ail/pmu/'.$id)->asJson()->get();
        return view('admin.ticketspris.details.detailspmuplr',compact('results'));
    }

     public function detailsPmuAlr($id=null){
        $ipadress_api=$this->ipconfig->ipadress();
        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté un détails du jeu PLR(Tickets pris)",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        $results = Curl::to($ipadress_api.'/admin/alr/'.$id)->asJson()->get();
        return view('admin.ticketspris.details.detailspmualr',compact('results'));
    }

    public function detailsSportcash($id=null){
        $ipadress_api=$this->ipconfig->ipadress();
        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté un détails du jeu Sportcash(Tickets pris)",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        $results = Curl::to($ipadress_api.'/admin/sportcash/'.$id)->asJson()->get();
        return view('admin.ticketspris.details.detailssportcash',compact('results'));
        
    }

    /**** Debut VALIDATION EN ATTENTE DE PAIEMENT ****/

    public function  waitWinEppl(Request $request){

       /*  $ipadress_api=$this->ipconfig->ipadress();
         $status= $request->status;
         $transaction_id= $request->transaction_id;

         $response_eppl = Curl::to($ipadress_api.'/admin/ail/loto/payments/validate')
                ->withData([
                    'transaction_id'=> $transaction_id,
                    'validated'=>$status
                ])
                ->asJson()
                ->post();

         dd($response_eppl);*/
        
         
     }

     public function  waitWinAlr(Request $request){

        $ipadress_api=$this->ipconfig->ipadress();
         $status= $request->status;
         $transaction_id= $request->transaction_id;

         $response_alr= Curl::to($ipadress_api.'/admin/alr/payments/validate')
                ->withData([
                    'transaction_id'=> $transaction_id,
                    'validated'=>$status
                ])
                ->asJson()
                ->post();

         dd($response_alr);
        
         
     }
     public function  waitWinPlr(Request $request){

        $ipadress_api=$this->ipconfig->ipadress();
         $status= $request->status;
         $transaction_id= $request->transaction_id;

         $response_plr= Curl::to($ipadress_api.'/admin/ail/pmu/payments/validate')
                ->withData([
                    'transaction_id'=> $transaction_id,
                    'validated'=>$status
                ])
                ->asJson()
                ->post();

         dd($response_plr);
        
         
     }
     public function  waitWinSportcash(Request $request){
        
        $ipadress_api=$this->ipconfig->ipadress();
         $status= $request->status;
         $transaction_id= $request->transaction_id;

         $response_sportcash= Curl::to($ipadress_api.'/admin/sportcash/payments/validate')
                ->withData([
                    'transaction_id'=> $transaction_id,
                    'validated'=>$status
                ])
                ->asJson()
                ->post();

         dd($response_sportcash);
         
     }

     public function  waitWinLoto(Request $request){
         $ipadress_api=$this->ipconfig->ipadress();
         $status= $request->status;
         $transaction_id= $request->transaction_id;

         $response_loto = Curl::to($ipadress_api.'/admin/ail/loto/payments/validate')
                ->withData([
                    'transaction_id'=> $transaction_id,
                    'validated'=>$status
                ])
                ->asJson()
                ->post();

         dd($response_loto);
     }

      /**** Fin VALIDATION EN ATTENTE DE PAIEMENT ****/

}
