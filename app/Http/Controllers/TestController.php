<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Spatie\Permission\Models\Role;
use Alert;

use App\Utilities\Ipconfig;

class TestController extends Controller
{

    protected $ipconfig;

    public function __construct(Ipconfig $ipconfig){
        $this->ipconfig=$ipconfig;

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSearch()
    {
        
        return view('home');
    }

    public function search(Request $request)
    {
          Alert::message('Analyste Programmeur');
         
        return view('home');
    
    }

}
