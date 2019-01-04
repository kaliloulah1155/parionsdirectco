<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Session;
use App\User;
use Carbon\Carbon;
use Hash;
use DB;
use Ixudra\Curl\Facades\Curl;
use App\Utilities\Ipconfig;
use Alert;


class AdminController extends Controller
{
    use AuthenticatesUsers;

    protected $ipconfig;

    public function __construct(Ipconfig $ipconfig){
        $this->ipconfig=$ipconfig;

    }

    function index(){
        return view('admin.admin_login');
    }

    public function connexion(Request $request){
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required|alphaNum|min:3'
        ]);
        $data=array(
            'email'=>$request['email'],
            //'password'=>Hash::make($request['password']) ,
            'password'=>$request['password'],

        );

        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');

        $user = User::whereEmail($request->get('email'))->first();

        

        if(!$user){
             Alert::error('Données incorrectes')->persistent('Fermer');
            return redirect('/login');
        }else{

           
           if((Auth::attempt($data))){
             $request->session()->regenerate();
            /*Debut  Piste d'audits */
             $datap=[];
            $datap[]=[
                'utilisateur'=>$user->email,
                'action'=>'vient de se connecter',
                'type'=>'authentification',
                'dates'=> $currentD, // date de la creation de l'audits
                'heures'=> $currentH,   //formatage heure
            ];
            DB::table('logaudits')->insert($datap);
            /* fin piste d'audits */
                    Alert::success('Bienvenue')->persistent('Fermer');
                    return redirect('/admin/dashboard');
            }else{
                Alert::error("ce compte n'a pas de profil")->persistent('Fermer');
                return redirect('/login');
            }
        }

       /*

    	*/
    }
    public function settings(){
        return view('admin.settings');
    }

    public function dashboard(){

        $ipadress_api=$this->ipconfig->ipadress();

        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté le dashboard",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

       /** PMU LOTO **/
        $resultatsLoto = Curl::to($ipadress_api.'/admin/ail/loto/stats')->asJson()->get();
        $listDataLoto=$resultatsLoto->data;
        $encoursLoto=$listDataLoto->processing->total;
        $rembourserLoto = $listDataLoto->refund->total;
        $mntrembourserLoto = $listDataLoto->refund->amount;
        $annulerLoto= $listDataLoto->canceled->total;
        $mntannulerLoto= $listDataLoto->canceled->canceled_amount;
        $perdantLoto=$listDataLoto->lost->total;
        $mntperdantLoto=$listDataLoto->lost->amount;
        $gagnantLoto=$listDataLoto->winning->total;
        $mntgagnantLoto=$listDataLoto->winning->amount;
        $TmntgagnantLoto=$listDataLoto->winning->win_amount;

        $totalLotoTicket= $encoursLoto+$rembourserLoto+$annulerLoto+$perdantLoto+$gagnantLoto;
        $totalLotoMnt=$mntrembourserLoto+$mntannulerLoto+$mntgagnantLoto;


       /** PMU PLR **/
        $resultatsPlr = Curl::to($ipadress_api.'/admin/ail/pmu/stats')->asJson()->get();
        $listDataPlr=$resultatsPlr->data;
        $encoursPlr=$listDataPlr->processing->total;
        $rembourserPlr = $listDataPlr->refund->total;
        $mntrembourserPlr = $listDataPlr->refund->amount;
        $annulerPlr= $listDataPlr->canceled->total;
        $mntannulerPlr= $listDataPlr->canceled->canceled_amount;
        $perdantPlr=$listDataPlr->lost->total;
        $mntperdantPlr=$listDataPlr->lost->amount;
        $gagnantPlr=$listDataPlr->winning->total;
        $mntgagnantPlr=$listDataPlr->winning->amount;
        $TmntgagnantPlr=$listDataPlr->winning->win_amount;

        $totalPlrTicket= $encoursPlr+$rembourserPlr+$annulerPlr+$perdantPlr+$gagnantPlr;
        $totalPlrMnt=$mntrembourserPlr+$mntannulerPlr+$mntgagnantPlr;
        


        /** PMU ALR **/
        $resultatsAlr = Curl::to($ipadress_api.'/admin/alr/stats')->asJson()->get();
        $listDataAlr=$resultatsAlr->data;
        $encoursAlr=$listDataAlr->processing->total;
        $rembourserAlr = $listDataAlr->refund->total;
        $annulerAlr= $listDataAlr->canceled->total;
        $mntannulerAlr= $listDataAlr->canceled->canceled_amount;
        $perdantAlr=$listDataAlr->lost->total;
        $mntperdantAlr=$listDataAlr->lost->amount;
        $gagnantAlr=$listDataAlr->winning->total;
        $mntgagnantAlr=$listDataAlr->winning->amount;
        $TmntgagnantAlr=$listDataAlr->winning->win_amount;

        $totalAlrTicket= $encoursAlr+$rembourserAlr+$annulerAlr+$perdantAlr+$gagnantAlr;
        $totalAlrMnt=$mntannulerAlr+$mntgagnantAlr;

      
       /** sportcash **/
       $resultatsSportcash = Curl::to($ipadress_api.'/admin/sportcash/stats')->asJson()->get();
       $listDataSportcash=$resultatsSportcash->data;
       $encoursSportcash=$listDataSportcash->processing->total;
       $rembourserSportcash = $listDataSportcash->refund->total;
       // $mntrembourser = $listData->refund->amount;
        $annulerSportcash= $listDataSportcash->canceled->total;
        $mntannulerSportcash= $listDataSportcash->canceled->canceled_amount;
        $perdantSportcash=$listDataSportcash->lost->total;
        $mntperdantSportcash=$listDataSportcash->lost->amount;
        $gagnantSportcash=$listDataSportcash->winning->total;
        $mntgagnantSportcash=$listDataSportcash->winning->amount;
        $TmntgagnantSportcash=$listDataSportcash->winning->win_amount;

        $totalSportcashTicket= $encoursSportcash+$rembourserSportcash+$annulerSportcash+$perdantSportcash+$gagnantSportcash;
        $totalSportcashMnt=$mntannulerSportcash+$mntgagnantSportcash;

       /** les jeux digitaux**/
       $resultatseppl = Curl::to($ipadress_api.'/admin/eppl/stats')->asJson()->get();
       $listDataEppl=$resultatseppl->data;

       /** TOTAUX **/
          $totalTicket=$totalPlrTicket+$totalLotoTicket+$totalAlrTicket+$totalSportcashTicket;
          $totalMnt=$totalAlrMnt+$totalPlrMnt+$totalLotoMnt+$totalSportcashMnt;
          $gagnant=$gagnantLoto+$gagnantSportcash+$gagnantAlr+$gagnantPlr;
          $mntgagnant= $mntgagnantSportcash+$mntgagnantAlr+$mntgagnantPlr+$mntgagnantLoto;
       


        return view('admin.admin_dashboard',compact(
            /** TOTAL **/
            'totalTicket',
            'totalMnt',
            'gagnant',
            'mntgagnant',
            /** LOTO **/
             'totalLotoTicket',
             'totalLotoMnt',
             'gagnantLoto',
             'mntgagnantLoto',

            /** PLR **/
             'totalPlrTicket',
             'totalPlrMnt',
             'gagnantPlr',
             'mntgagnantPlr',

             /** ALR **/
             'totalAlrTicket',
             'totalAlrMnt',
             'gagnantAlr',
             'mntgagnantAlr',

              /** SPORTCASH **/
             'totalSportcashTicket',
             'totalSportcashMnt',
             'gagnantSportcash',
             'mntgagnantSportcash'
           

        ));

    }
    public function logout(){

        /*Debut  Piste d'audits */


        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];

        if($user->email){
         $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"s'est déconnecté",
            'type'=>'déconnexion',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
            ];
            DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        }else{
            return redirect('/login');
        }
        Auth::logout();
        Session::flush();
       return redirect('/login');
    }

}
