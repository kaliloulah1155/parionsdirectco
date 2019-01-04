@extends('layouts.adminLayout.admin_design')
@section('title', 'LONACI::Administration')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Modification de profils d'administration</h4>
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
            @can('Création de profil')
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <div class="card card-hover">
                    <div class="box text-center">
                        <h1 class="font-light text-black"><i class="mdi mdi-account-circle"></i></h1>

                        <a class="text-dark" href="{{route('add_role')}}">Créer un profil</a>

                    </div>
                </div>
            </div>
        @endcan
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-warning text-center">
                        <h1 class="font-light text-black"><i class="mdi mdi-account-location"></i></h1>
                        <a class="text-dark" href="{{ route('voir_role') }}">Liste des profils</a>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form class="form-horizontal" method="POST" action="{{ URL::to('/admin/update_role/'.$role->id) }}" name="add_profil" id="add_profil" novalidate="novalidate">
                        @csrf
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="card-body">
                            <style>
                                #intitle-error , #departement-error, #responsable-error{
                                    color: red;
                                }
                            </style>
                            <h4 class="card-title">Information du profil</h4>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Intitulé</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="intitle" value="{{$role->name }}" name="name"  placeholder="Veuillez entrer l'intitulé du profil">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="depart" class="col-sm-3 text-right control-label col-form-label">Département</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="departement" name="departement" value="{{$role->departement }}" placeholder="Veuillez rentrer le nom du chef de département">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lname" class="col-sm-3 text-right control-label col-form-label">Responsable</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="responsable" name="responsable" value="{{$role->responsable }}" placeholder="Veuillez entrer le nom du chef de département">
                                </div>
                            </div>
                        </div>
                        @can('Modification de profil')
                        
                          <div class="row card-body">
                              <div class="col-sm-12">
                                <div class="text-center">
                                   <button type="submit" class="btn btn-success text-dark center-block">Valider</button>
                                </div>
                              </div>
                        </div> 
                        @endcan
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
