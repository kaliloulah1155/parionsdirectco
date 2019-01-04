@extends('layouts.adminLayout.admin_design')

@section('title', 'LONACI::Administration')
@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Contenu du message</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('getsms')}}" >SMS</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('getsmshistoric')}}"  style="color:black">Historique des messages envoyés</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Détails du mail</h5>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td><h4>Date d'envoi</h4></td>  
                          <td>{{$smsDetails->dates}} à {{$smsDetails->heures}}</td> 
                        </tr>
                        <tr>
                            <td><h4>Destinataire</h4></td> {{-- intituler --}}
                            <td>{{$smsDetails->telephone}}</td>
                        </tr>
                        <tr>
                            <td><h4>Objet</h4></td>
                            <td>{{$smsDetails->titre}}</td>
                        </tr>
                        <tr>
                            <td><h4>Corps</h4></td>
                            <td>{{$smsDetails->smscontents}}</td>
                        </tr>
                        <tr>
                            <td><h4>Statut</h4></td> {{-- intituler --}}
                            <td>Succès</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



@endsection
