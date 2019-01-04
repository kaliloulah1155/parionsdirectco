@extends('layouts.adminLayout.admin_design')

@section('title', 'LONACI::Administration')
@section('content')

   <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Liste loto bonheur</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Liste des tickets pris</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> <a href="{{route('lotobonheur')}}">loto bonheur</a></li>
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
                    <h5 class="card-title">Détails du loto</h5>
                    <table class="table">

                        <tbody>

                            <tr>
                                <td><h4>Id transaction</h4></td>
                                <td>{{ $results->data->transaction_id }}</td>
                            </tr>
                            <tr>
                                <td><h4>N° du ticket</h4></td>
                                <td>{{ $results->data->ticket_number }}</td>
                            </tr>
                            <tr>
                                <td><h4>Montant</h4></td>
                                <td>{{ $results->data->earning_amount }}</td>
                            </tr>
                            <tr>
                                <td><h4>Id du joueur</h4></td>
                                <td>{{ $results->data->gamer_id }}</td>
                            </tr>
                            <tr>
                                <td><h4>SMS</h4></td>
                                <td>{{ $results->data->sms_content }}</td>
                            </tr>
                            <tr>
                                <td><h4>Date de création</h4></td>
                                <td>{{ (new DateTime($results->data->created_at))->format('d/m/Y à h\h:i\m\n ') }}</td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
