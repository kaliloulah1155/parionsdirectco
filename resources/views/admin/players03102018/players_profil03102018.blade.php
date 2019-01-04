@extends('layouts.adminLayout.admin_design')

@section('title', 'LONACI::Administration')
@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Profil du joueur</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('players_list')}}">Liste des joueurs</a></li>
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
                    <h5 class="card-title">Détails du joueur</h5>
                    <table class="table">

                        <tbody>

                            <tr>
                                <td><h4>Nom</h4></td>
                                <td>{{ $results->data->firstname }}</td>
                            </tr>
                            <tr>
                                <td><h4>Prénoms</h4></td>
                                <td>{{ $results->data->lastname }} </td>
                            </tr>
                            <tr>
                                <td><h4>Pseudonyme</h4></td>
                                <td>{{ $results->data->pseudo }}</td>
                            </tr>
                            <tr>
                                <td><h4>Adresse email</h4></td>
                                <td>{{ $results->data->email }}</td>
                            </tr>
                            <tr>
                                <td><h4>Identifiant</h4></td>
                                <td>{{ $results->data->uuid }}</td>
                            </tr>
                            <tr>
                                <td><h4>Téléphone</h4></td> {{-- intituler --}}
                                <td>{{ $results->data->msisdn }}</td>
                            </tr>
                            <tr>
                                <td><h4>Civilité</h4></td> {{-- intituler --}}
                                @if( $results->data->sex_id==1)
                                    <td>M.</td>
                                    @else
                                    <td>M./Mlle/Mme</td>
                                @endif

                            </tr>
                            <tr>
                                <td><h4>Sexe</h4></td> {{-- intituler --}}
                                <td>M/F</td>
                            </tr>
                            <tr>
                                <td><h4>Date de naissance</h4></td>
                                <td>{{ (new DateTime($results->data->birthdate))->format('d/m/Y à h\h:i\m\n ') }}</td>

                            </tr>

                            <tr>
                                <td><h4>Date de création</h4></td>
                                <td>{{ (new DateTime($results->data->created_at))->format('d/m/Y à h\h:i\m\n ') }}</td>
                            </tr>
                            <tr>
                                <td><h4>Date d'activation</h4></td>
                                <td>{{ (new DateTime($results->data->confirmed_at))->format('d/m/Y à h\h:i\m\n ') }}</td>

                            </tr>
                            <tr>
                                <td><h4>Dernière connexion</h4></td>
                                <td>{{ (new DateTime($results->data->last_connection_date))->format('d/m/Y à h\h:i\m\n ') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
