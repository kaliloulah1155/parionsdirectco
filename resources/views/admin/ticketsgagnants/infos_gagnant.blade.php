@extends('layouts.adminLayout.admin_design')

@section('title', 'LONACI::Administration')
@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Profil du parieur</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Infos du gagnant</a></li>
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
                    <h5 class="card-title">Détails du gagnant</h5>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td><h4>Statut du pari</h4></td>
                            <td>Gagnant</td>
                        </tr>
                        <tr>
                            <td><h4>Date de prise du pari</h4></td> {{-- intituler --}}
                            <td>25/07/2018</td>
                        </tr>
                        <tr>
                            <td><h4>Début de l'événement</h4></td> {{-- intituler --}}
                            <td>25/07/2018</td>
                        </tr>
                        <tr>
                            <td><h4>Fin de l'événement</h4></td>
                            <td>25/07/2018</td>
                        </tr>
                        <tr>
                            <td><h4>Montant du gain</h4></td>
                            <td>1 440 000</td>
                        </tr>
                        <tr>
                            <td><h4>Date de paiement des gains</h4></td> {{-- intituler --}}
                            <td>23-02-2018  a 13h31 min</td>
                        </tr>
                        <tr>
                            <td><h4>Date de paiement différée</h4></td> {{-- intituler --}}
                            <td>24-02-2018  a 13h31 min</td>
                        </tr>
                        <tr>
                            <td><h4>Numéro de compte paymoney</h4></td> {{-- intituler --}}
                            <td>8540774</td>
                        </tr>
                        <tr>
                            <td><h4>Identifiant de la transaction</h4></td> {{-- intituler --}}
                            <td>55511215212500545233344555</td>
                        </tr>

                        <tr>
                            <td><h4>Numéro de ticket</h4></td>
                            <td>781222</td>
                        </tr>
                        <tr>
                            <td><h4>Numéro de référence</h4></td>
                            <td>22407</td>
                        </tr>
                        <tr>
                            <td><h4>Numéro d' audit</h4></td>
                            <td>85521</td>
                        </tr>
                        <tr>
                            <td><h4>Montant du pari</h4></td>
                            <td>10 000 000 FCFA</td>
                        </tr>
                        <tr>
                            <td><h4>Id du message</h4></td>
                            <td>11912268</td>
                        </tr>
                        <tr>
                            <td><h4>Catégorie de pari</h4></td>
                            <td>ras</td>
                        </tr>
                        <tr>
                            <td><h4>Type de pari</h4></td>
                            <td>231</td>
                        </tr>
                        <tr>
                            <td><h4>Bet modifier</h4></td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td><h4>Selector 1</h4></td>
                            <td>16</td>
                        </tr>
                        <tr>
                            <td><h4>Selector 2</h4></td>
                            <td>16</td>
                        </tr>
                        <tr>
                            <td><h4>Nombre de fois</h4></td>
                            <td>160</td>
                        </tr>
                        <tr>
                            <td><h4>Normal count</h4></td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td><h4>Special count</h4></td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td><h4>Entries</h4></td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td><h4>Sélections</h4></td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td><h4>Bases</h4></td>
                            <td>17,20,30,32,31</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
