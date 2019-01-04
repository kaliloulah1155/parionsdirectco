@extends('layouts.adminLayout.admin_design')

@section('title', 'LONACI::Administration')
@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Liste des gagnants de jeux</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Tickets gagnants</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Gagnants de jeux</li>
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
                    <div class="card-body">
                        <h5 class="card-title">Liste des gagnants du jeux LOTO </h5>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Création</th>
                                    <th style="text-align: center">Jeux</th>
                                    <th style="text-align: center">Statut</th>
                                    <th style="text-align: center">N° de Transaction</th>
                                    <th style="text-align: center">Mise</th>
                                    <th style="text-align: center">Montant du gain</th>
                                    <th style="text-align: center">Détails</th>

                                </tr>
                                </thead>
                                 <tbody>
                                @foreach ($lotos as $loto)
                                    <tr>
                                        <td>{{  (new DateTime($loto->created_at))->format('d/m/Y ') }}</td>
                                        <td> loto</td>
                                        <td>{{  $loto->bet_status }}</td>
                                        <td>{{  $loto->transaction_id }}</td>
                                        <td>{{  $loto->bet_cost_amount }}</td>
                                        <td>{{  $loto->earning_amount }}</td>
                                        <td>Date de debut:{{   (new DateTime($loto->begin_at))->format('d/m/Y ') }} Date de fin: {{  (new DateTime($loto->end_at))->format('d/m/Y ') }}</td>
                                        <td style="text-align: center">
                                            <a  href="{{route('infosgagnant')}}"  class="btn btn-cyan btn-sm  mdi mdi-account-star-variant" title="Détails"></a>
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

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Liste des gagnants du jeux PMU ALR</h5>
                        <div class="table-responsive">
                            <table id="zero_config1" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Création</th>
                                    <th style="text-align: center">Jeux</th>
                                    <th style="text-align: center">Statut</th>
                                    <th style="text-align: center">N° de Transaction</th>
                                    <th style="text-align: center">Mise</th>
                                    <th style="text-align: center">Montant du gain</th>
                                    <th style="text-align: center">Détails</th>
                                   
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($alrs as $alr)
                                    <tr>
                                        <td>{{  (new DateTime($alr->created_at))->format('d/m/Y ') }}</td>
                                        <td> alr</td>
                                        <td>{{  $alr->bet_status }}</td>
                                        <td>{{  $alr->transaction_id }}</td>
                                        <td>{{  $alr->amount }}</td>
                                        <td>{{  $alr->win_amount }}</td>
                                        <td>Date de debut:{{   (new DateTime($alr->begin_at))->format('d/m/Y ') }} Date de fin: {{  (new DateTime($alr->end_at))->format('d/m/Y ') }}</td>
                                        <td style="text-align: center">
                                            <a  href="{{route('infosgagnant')}}"  class="btn btn-cyan btn-sm  mdi mdi-account-star-variant" title="Détails"></a>
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

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Liste des gagnants du jeux PMU PLR</h5>
                        <div class="table-responsive">
                            <table id="zero_config2" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Création</th>
                                    <th style="text-align: center">Jeux</th>
                                    <th style="text-align: center">Statut</th>
                                    <th style="text-align: center">N° de Transaction</th>
                                    <th style="text-align: center">Mise</th>
                                    <th style="text-align: center">Montant du gain</th>
                                    <th style="text-align: center">Détails</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($plrs as $plr)
                                    <tr>
                                        <td>{{  (new DateTime($plr->created_at))->format('d/m/Y ') }}</td>
                                        <td> plr</td>
                                        <td>{{  $plr->bet_status }}</td>
                                        <td>{{  $plr->transaction_id }}</td>
                                        <td>{{  $plr->bet_cost_amount }}</td>
                                        <td>{{  $plr->earning_amount }}</td>
                                        <td>Date de debut:{{   (new DateTime($plr->begin_at))->format('d/m/Y ') }} Date de fin: {{  (new DateTime($plr->end_at))->format('d/m/Y ') }}</td>
                                       
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Liste des gagnants du jeux SPORTCASH</h5>
                        <div class="table-responsive">
                            <table id="zero_config3" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Création</th>
                                    <th style="text-align: center">Jeux</th>
                                    <th style="text-align: center">Statut</th>
                                    <th style="text-align: center">N° de Transaction</th>
                                    <th style="text-align: center">Mise</th>
                                    <th style="text-align: center">Montant du gain</th>
                                    <th style="text-align: center">Détails</th>
                                   
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($sportcashs as $sportcash)
                                    <tr>
                                        <td>{{  (new DateTime($sportcash->created_at))->format('d/m/Y ') }}</td>
                                        <td> sportcash</td>
                                        <td>{{  $sportcash->bet_status }}</td>
                                        <td>{{  $sportcash->transaction_id }}</td>
                                        <td>{{  $sportcash->amount }}</td>
                                        <td>{{  $sportcash->win_amount }}</td>
                                        <td>Date de debut:{{   (new DateTime($sportcash->begin_at))->format('d/m/Y ') }} Date de fin: {{  (new DateTime($sportcash->end_at))->format('d/m/Y ') }}</td>
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
