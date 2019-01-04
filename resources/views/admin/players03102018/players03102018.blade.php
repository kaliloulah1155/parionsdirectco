@inject('helpurl','App\helpers')

@extends('layouts.adminLayout.admin_design')

@section('title', 'LONACI::Administration')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Liste des joueurs</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('players_list')}}" >Liste des joueurs</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" data-find="_7">
        <div class="row d-flex justify-content-center">
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <div class="card card-hover">
                    <div class="box text-center" style="background:white;">
                        <h1 class="font-light text-black">({{ $cmpttotaldata }})</h1>
                        <h1 class="text-dark">Joueurs inscrit(s)</h1>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-success text-center">
                        <h1 class="font-light text-white">({{ $cmptconfirmed}})</h1>
                        <h1 class="text-dark" >Compte(s) confirmé(s)</h1>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-4 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-warning text-center">
                        <h1 class="font-light text-white">({{ $cmptunconfirmed }})</h1>
                        <h1 class="text-dark">Compte(s) en attente de confirmation</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="border-top">
                        <div class="card-body">
                            <a  href="{{route('exportex')}}"  class="btn btn-danger">EXPORTER</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Liste des parieurs</h5>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Noms</th>
                                    <th>Prénoms</th>
                                    <th>emails</th>
                                    <th>Téléphones</th>
                                    <th>Date de création</th>
                                    <th>Date d'activation</th>
                                    <th>Dernière connexion</th>
                                    <th style="text-align: center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($lists as $list)
                                    <tr>
                                        <td>{{  $list->firstname }}</td>
                                        <td>{{  $list->lastname }}</td>
                                         <td>{{  $list->email }}</td>
                                         <td>{{  $list->msisdn }}</td>
                                         <td>{{  (new DateTime($list->created_at))->format('d/m/Y à h\h:i\m\n ') }}</td>
                                         <td>{{  (new DateTime( $list->confirmed_at))->format('d/m/Y à h\h:i\m\n ') }}</td>
                                         <td>{{  (new DateTime( $list->last_connection_date))->format('d/m/Y à h\h:i\m\n ') }}</td>
                                        <td style="text-align: center">
                                            <a  href="{{ URL::to('/admin/players_profil/'.$list->id) }}"  class="btn btn-cyan btn-sm  mdi mdi-account-star-variant" title="Détails"></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_scripts')
    <script>
        $(document).ready(function(){
           $('.pagination').hide();
        });
    </script>
@stop
