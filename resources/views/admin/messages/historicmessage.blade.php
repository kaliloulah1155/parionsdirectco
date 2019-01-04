@extends('layouts.adminLayout.admin_design')

@section('title', 'LONACI::Administration')
@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Historique des messages</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('smscontent')}}" >SMS</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('smshistoric')}}" style="color:black">Historique des messages envoyés</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="border-top">
                        <div class="card-body">
                            <a  href="#"  class="btn btn-danger">EXPORTER</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Liste des histotiques </h5>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th style="text-align: center">Destinataire</th>
                                    <th style="text-align: center">Sujet</th>
                                    <th style="text-align: center">Corps du mail</th>
                                    <th style="text-align: center">Statut</th>
                                    <th style="text-align: center">Dates</th>
                                    <th style="text-align: center">Heures</th>
                                    <th style="text-align: center">Actions</th>

                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($smsmessages as $smsmessage)
                                        <tr>
                                            <td>{{ $smsmessage->emails }}</td>
                                            <td>{{ $smsmessage->titre }}</td>
                                            <td>....</td>
                                            <td>Succès</td>
                                            <td>{{ $smsmessage->dates }}</td>
                                            <td>{{ $smsmessage->heures }}</td>
                                            <td style="text-align: center">
                                                <a  href="{{ URL::to('/admin/smsdetail/'.$smsmessage->id) }}"  class="btn btn-cyan btn-sm  mdi mdi-account-star-variant" title="Détails"></a>
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
