@extends('layouts.adminLayout.admin_design')

@section('title', 'LONACI::Administration')
@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Liste des profils d'administration</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Administration</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Gestion de profil</li>
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
                    <div class="box text-center">
                        <h1 class="font-light text-black"><i class="mdi mdi-account-circle"></i></h1>
                        <a class="text-dark" href="{{route('add_user')}}">Créer un utilisateur</a>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-warning text-center">
                        <h1 class="font-light text-black"><i class="mdi mdi-account-location"></i></h1>
                        <a class="text-dark" href="{{ route('voir_user') }}">Liste des utilisateurs</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Détails des utilisateurs</h5>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><h4>Profil</h4></td>
                                    @if(!empty($userDetails->getRoleNames()))
                                        @foreach($userDetails->getRoleNames() as $v)
                                            <td>{!! $v !!}</td>
                                        @endforeach
                                    @endif

                                </tr>
                                <tr>
                                    <td><h4>Nom</h4></td>
                                    <td>{{$userDetails->firstname}}</td>
                                </tr>
                                <tr>
                                    <td><h4>Prénoms</h4></td> {{-- intituler --}}
                                    <td>{{$userDetails->lastname}}</td>
                                </tr>
                                <tr>
                                    <td><h4>Numéro de téléphone</h4></td> {{-- intituler --}}
                                    <td>{{$userDetails->phone_number}}</td>
                                </tr>
                                <tr>
                                    <td><h4>Adresse email</h4></td>
                                    <td>{{$userDetails->email}}</td>
                                </tr>
                                <tr>
                                    <td><h4>Crée le</h4></td>
                                    <td>{{$userDetails->created_at}}</td>
                                </tr>
                                <tr>
                                    <td><h4>Modifié le</h4></td>
                                    <td>{{$userDetails->updated_at}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
