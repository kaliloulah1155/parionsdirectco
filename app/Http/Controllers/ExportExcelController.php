<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;
use Auth;
use Carbon\Carbon;
use Ixudra\Curl\Facades\Curl;
use App\Utilities\Ipconfig;

class ExportExcelController extends Controller
{
    protected $ipconfig;

    public function __construct(Ipconfig $ipconfig){
        $this->ipconfig=$ipconfig;

    }

    function excel()
    {
        $ipadress_api=$this->ipconfig->ipadress();
        
        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a exporté la liste des joueurs",
            'type'=>'exportation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        $gamers_data = Curl::to($ipadress_api.'/admin/gamers')->asJson()->get();
        $listgamers_data=$gamers_data->data->list;

        $listgamers_array[]=array(
            'Id',
            'Civilité',
            'Nom',
            'Prénom',
            'Pseudo',
            'Sexe',
            'Email',
            'Téléphone',
          //  'Compte paymoney',
            'Date de naissance',
            'Date de création',
            'Dernière date de connexion',
          //  'Uuid',
        );
    

        

        foreach ( $listgamers_data as $listgamer){

            if(trim($listgamer->civility_id)==1){
                $civ='M.';
            }else{
                $civ='Mme';
            }

            if(trim($listgamer->sex_id)==1){
                $sex='M';
            }else{
                $sex='F';
            }

            $listgamers_array[]=array(
                'Id'=>$listgamer->id,
                'Civilité'=>$civ,
                'Nom'=>$listgamer->firstname,
                'Prénom'=>$listgamer->lastname,
                'Pseudo'=>$listgamer->pseudo,
                'Sexe'=>$sex,
                'Email'=>$listgamer->email,
                'Téléphone'=>$listgamer->msisdn,
               // 'Compte paymoney'=>$listgamer->paymoney_account,
                'Date de naissance'=>$listgamer->birthdate,
                'Date de création'=>$listgamer->created_at,
                'Dernière date de connexion'=>$listgamer->last_connection_date,
                //'Uuid'=>$listgamer->uuid,

            );
        }
        Excel::create('Gamers data',function($excel) use ($listgamers_array){
              $excel->setTitle('Gamers data');
              $excel->sheet('Gamers data',function ($sheet) use ($listgamers_array){
                     $sheet->fromArray($listgamers_array,null,'A1',false,false);
              });
        })->download('xlsx');
    }

    function loto(){
        
        $ipadress_api=$this->ipconfig->ipadress();

        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a exporté la liste des joueurs de loto",
            'type'=>'exportation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        $loto_data = Curl::to($ipadress_api.'/admin/ail/loto/winnings')->asJson()->get();

        $listloto_data=$loto_data->data;

        $listloto_array[]=array(
            'Création',
            'Jeux',
            'Statut',
            'Mise',
            'N° de transaction',
            'Montant du gain',
            'Date de Début',
            'Date de Fin',
        );
        foreach ( $listloto_data as $listloto){
            $listloto_array[]=array(
               // 'Id'=>$listgamer->id,
                'Création'=>$listloto->created_at,
                'Jeux'=>'loto',
                'Statut'=>$listloto->bet_status, 
                'Mise'=>$listloto->bet_cost_amount, 
                'N° de transaction'=>$listloto->transaction_id,
                'Montant du gain'=>$listloto->earning_amount,
                'Date de Début'=>$listloto->begin_at,
                'Date de Fin'=>$listloto->end_at,
            );
        }
        Excel::create('Loto_win data',function($excel) use ($listloto_array){
              $excel->setTitle('Loto_win data');
              $excel->sheet('Loto_win data',function ($sheet) use ($listloto_array){
                     $sheet->fromArray($listloto_array,null,'A1',false,false);
              });
        })->download('xlsx');
    }

    function sportcash(){

        $ipadress_api=$this->ipconfig->ipadress();
        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a exporté la liste des joueurs de sportcash",
            'type'=>'exportation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        $sportcash_data = Curl::to($ipadress_api.'/admin/sportcash/winnings')->asJson()->get();

        $listsportcash_data=$sportcash_data->data;

        $listsportcash_array[]=array(
            'Création',
            'Jeux',
            'Statut',
            'N° de transaction',
            'Mise',
            'Montant du gain',
            'Date de Début',
            'Date de Fin',
        );
        foreach ( $listsportcash_data as $listsportcash){
            $listsportcash_array[]=array(
               // 'Id'=>$listgamer->id,
                'Création'=>$listsportcash->created_at,
                'Jeux'=>'sportcash',
                'Statut'=>$listsportcash->bet_status, 
                'N° de transaction'=>$listsportcash->transaction_id,
                'Mise'=>$listsportcash->amount,
                'Montant du gain'=>$listsportcash->win_amount,
                'Date de Début'=>$listsportcash->begin_at,
                'Date de Fin'=>$listsportcash->end_at,
            );
        }
        Excel::create('Sportcash_win data',function($excel) use ($listsportcash_array){
              $excel->setTitle('Sportcash_win data');
              $excel->sheet('Sportcash_win data',function ($sheet) use ($listsportcash_array){
                     $sheet->fromArray($listsportcash_array,null,'A1',false,false);
              });
        })->download('xlsx');
    }

    function alr(){

        $ipadress_api=$this->ipconfig->ipadress();

        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a exporté la liste des joueurs alr",
            'type'=>'exportation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        $alr_data = Curl::to( $ipadress_api.'/admin/alr/winnings')->asJson()->get();

        $listalr_data=$alr_data->data;

        $listalr_array[]=array(
            'Création',
            'Jeux',
            'Statut',
            'N° de transaction',
            'Mise',
            'Montant du gain',
            'Date de Début',
            'Date de Fin',
        );
        foreach ( $listalr_data as $listalr){
            $listalr_array[]=array(
               // 'Id'=>$listgamer->id,
                'Création'=>$listalr->created_at,
                'Jeux'=>'alr',
                'Statut'=>$listalr->bet_status, 
                'N° de transaction'=>$listalr->transaction_id,
                'Mise'=>$listalr->amount,
                'Montant du gain'=>$listalr->win_amount,
                'Date de Début'=>$listalr->begin_at,
                'Date de Fin'=>$listalr->end_at,
            );
        }
        Excel::create('Alr_win data',function($excel) use ($listalr_array){
              $excel->setTitle('Alr_win data');
              $excel->sheet('Alr_win data',function ($sheet) use ($listalr_array){
                     $sheet->fromArray($listalr_array,null,'A1',false,false);
              });
        })->download('xlsx');
    }

    function plr(){
         $ipadress_api=$this->ipconfig->ipadress();

        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a exporté la liste des joueurs plr",
            'type'=>'exportation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        $plr_data = Curl::to($ipadress_api.'/admin/ail/pmu/winnings')->asJson()->get();

        $listplr_data=$plr_data->data;

        $listplr_array[]=array(
            'Création',
            'Jeux',
            'Statut',
            'Mise',
            'N° de transaction',
            'Montant du gain',
            'Date de Début',
            'Date de Fin',
        );
        foreach ( $listplr_data as $listplr){
            $listplr_array[]=array(
               // 'Id'=>$listgamer->id,
                'Création'=>$listplr->created_at,
                'Jeux'=>'plr',
                'Statut'=>$listplr->bet_status, 
                'Mise'=>$listplr->bet_cost_amount, 
                'N° de transaction'=>$listplr->transaction_id,
                'Montant du gain'=>$listplr->earning_amount,
                'Date de Début'=>$listplr->begin_at,
                'Date de Fin'=>$listplr->end_at,
            );
        }
        Excel::create('Plr_win data',function($excel) use ($listplr_array){
              $excel->setTitle('Plr_win data');
              $excel->sheet('Plr_win data',function ($sheet) use ($listplr_array){
                     $sheet->fromArray($listplr_array,null,'A1',false,false);
              });
        })->download('xlsx');
    }
}
