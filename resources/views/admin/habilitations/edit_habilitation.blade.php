@extends('layouts.adminLayout.admin_design')

@section('title', 'LONACI::Administration')
@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Liste des habilitations du profil  <b>{{ $role->name}} </b></h4>
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
            <div class="col-12 ">
                <div class="card" >
                    <form  class="form-horizontal" method="POST" action="{{ URL::to('/admin/habilitationval_role/'.$role->id) }}" name="add_profil" id="add_profil" novalidate="novalidate">
                        @csrf
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="card-body">
                            <style>
                                #intitle-error , #departement-error, #responsable-error{
                                    color: red;
                                }
                            </style>
                            <h4 class="card-title">Information de l'habilitation</h4>
                            <div class="col-xs-12 col-sm-12 col-md-12  form-horiz">
                                <div class="field-container inline-label-form ">
                                    <br/>
                                   <div class="field-boxes quarter">
                                        @foreach($permission as $value)
                                            <label>
                                                {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'ccheckb')) }}
                                                 <span>{{ $value->name }}</span>
                                            </label>
                                            <br/>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row card-body">
                              <div class="col-sm-12">
                                <div class="text-center">
                                   <button type="submit" class="btn btn-success text-dark center-block">Valider</button>
                                </div>
                              </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
