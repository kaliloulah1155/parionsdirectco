<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use MercurySeries\Flashy\Flashy;
use Carbon\Carbon;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessageCreated;
use App\Models\Smsmessages;
use App\Models\Smstext;
use Ramsey\Uuid\Uuid;
use App\Utilities\Ipconfig;
use Nexmo;
use Alert;

class SendSmsController extends Controller
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
            'action'=>"a consulté le formulaire d'envoi de message(SMS)",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        $results = Curl::to($ipadress_api.'/admin/gamers')->asJson()->get();
       // $cmpttotaldata= $results->data->total;
        $listgamers_data=$results->data->list;

        return view('admin.messages.messagecontent',compact('results','listgamers_data'));
    }
    public function historic(){

        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté l'historique des messages(SMS)",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        $smsmessages = Smsmessages::get();
        return view('admin.messages.historicmessage')->with(compact('smsmessages'));;
    }

    public function detail($id=null){

        $smsDetails=Smsmessages::find($id);

        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté les détails d'un message(SMS)",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        return view('admin.messages.detailmessage',compact('smsDetails'));
    }

    public function sendcontents( Request $request){
       
        $content= $request->input('about');
        $contentTitre=$request->input('titre');
        $contentFile=$request->input('file');
        $currentDates=Carbon::parse(new Carbon)->format('d/m/Y');
        $currentHeures=Carbon::parse(new Carbon)->format('H\h i\m\i\n s\s ');
        //$contentMail= explode(";",implode(";",$request->get('listgamers_data')));
      
        if($request->isMethod('POST')){

            $nbre_list=count($_POST['listgamers_data'])-1;
      
            for($i=0; $i<=$nbre_list;$i++)
              {
                
                  Smsmessages::create([
                            'emails'=>$_POST['listgamers_data'][$i],
                            'titre'=>$contentTitre,
                            'contentssms'=>$content,
                            'file'=>$contentFile,
                            'dates'=>$currentDates, // date de la creation
                            'heures'=> $currentHeures,   //formatage heure
                        ]);
               

                     $mailable=new ContactMessageCreated('adminbackoffice@admin.com'  , $contentTitre,$content);
                     Mail::to($_POST['listgamers_data'][$i])->send($mailable);
                }
                


            Alert::success('E-MAIL envoyé')->persistent('Fermer');

                   
           // Flashy::primary('Message envoyé', '#');
            
            return redirect(route('smscontent'));
        }

    }

    public function getsmscontent(Request $request){

        $ipadress_api=$this->ipconfig->ipadress();

       
        $content= $request->input('textsms');
        $contentTitre=$request->input('titre');
        $currentDates=Carbon::parse(new Carbon)->format('d/m/Y');
        $currentHeures=Carbon::parse(new Carbon)->format('H\h i\m\i\n s\s ');
       // $contentTelephone= empty($request->get('listgamers_data')) ? '22544904589' : '225'.implode(',225',$request->get('listgamers_data'));
          
        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a  envoyé des SMS)",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */
         

       
        $results = Curl::to($ipadress_api.'/admin/gamers')->asJson()->get();
        $listgamers_data=$results->data->list;


         /* debut insert SMS  */
        if($request->isMethod('POST')){
           
            $login = 'PDIRECT';
            $password = 'e65e1dab77399f20ac94b63a51223562';
            $service_id = 'PARIONSDIRECT';
            $sender = 'BOPDIRECT';
          //  $msisdn =$contentTelephone ;
            $msg=str_replace(' ', '%20',$content);


             $nbre_list=count($_POST['listgamers_data'])-1;
      
              for($i=0; $i<=$nbre_list;$i++)
              {
                 
                  Smstext::create([
                            'telephone'=>'225'.$_POST['listgamers_data'][$i],
                            'titre'=>$contentTitre,
                            'smscontents'=>$content,
                            'dates'=>$currentDates, // date de la creation
                            'heures'=> $currentHeures,   //formatage heure
                        ]);

                   $resultsApi_sms = Curl::to('http://94.247.180.108:9999/ad7e2b2a24677ed2eecf953edf1abfa1/b19e8e47-19f5-4162-8447-e56cb5ef8a34/api/message/'.$login.'/'.$password.'/'.$service_id.'/'.$sender.'/225'.$_POST['listgamers_data'][$i].'/'.$msg)->asJson()->get();   

                }
       
    
                  Alert::success('SMS envoyé')->persistent('Fermer');

        }

            /* fin insert SMS  */

        return view('admin.messages.sms.smscontent',compact('listgamers_data'));
    }


      public function getsms(){
           
    /*

        $resultsApi_sms = Curl::to('http://94.247.180.108:9999/ad7e2b2a24677ed2eecf953edf1abfa1/b19e8e47-19f5-4162-8447-e56cb5ef8a34/api/message/PDIRECT/e65e1dab77399f20ac94b63a51223562/PARIONSDIRECT/PDIRECT/22544904589/test')->asJson()->get();

        dd($resultsApi_sms);
*/
        $ipadress_api=$this->ipconfig->ipadress();

        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté le formulaire d'envoi de message(SMS)",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        $results = Curl::to($ipadress_api.'/admin/gamers')->asJson()->get();
      
        $listgamers_data=$results->data->list;
     
        return view('admin.messages.sms.smscontent',compact('listgamers_data'));
    }

     public function getsmshistoric(){

        
        $ipadress_api=$this->ipconfig->ipadress();

        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté l'historique des SMS",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */
   

        $smsmessages = Smstext::get();

        return view('admin.messages.sms.historicsms',compact('smsmessages'));
    }

    
    public function getsmsdetail($id=null){

        $smsDetails=Smstext::find($id);
         
        /*Debut  Piste d'audits */
        $user = Auth::user();
        $current = new Carbon;
        $currentD=Carbon::parse($current)->format('d/m/Y');
        $currentH=Carbon::parse($current)->format('H\h i\m\i\n s\s ');
        $datap=[];
        $datap[]=[
            'utilisateur'=>$user->email,
            'action'=>"a consulté les détails d'un SMS",
            'type'=>'consultation',
            'dates'=> $currentD, // date de la creation de l'audits
            'heures'=> $currentH,   //formatage heure
        ];
        DB::table('logaudits')->insert($datap);
        /* fin piste d'audits */

        return view('admin.messages.sms.detailsms',compact('smsDetails'));
    }

}
