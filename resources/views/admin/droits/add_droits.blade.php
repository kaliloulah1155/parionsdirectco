@extends('layouts.adminLayout.admin_design')

@section('title', 'LONACI::Administration')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Attribution des droits à l'utilisateur</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Administration</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('add_droit')}}" style="color:black">Gestion des droits</a></li>
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
                    <div class="box bg-cyan text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-account-circle"></i></h1>
                        <a class="text-dark" href="{{route('add_user')}}">Créer un utilisateur</a>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-warning text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-account-location"></i></h1>
                        <a class="text-dark" href="{{ route('voir_user') }}">Liste des utilisateurs</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form class="form-horizontal" method="POST" action="{{ url('/admin/add_droit') }}" name="add_droit" id="add_droit" novalidate="novalidate">
                        @csrf
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="card-body">
                            <h4 class="card-title">Attribution des droits</h4>
                            <div class="form-group row">
                                <label for="depart" class="col-sm-3 text-right control-label col-form-label"> Profils</label>
                                <div class="col-sm-4">
                                   {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','')) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Utilisateurs</label>
                                <div class="col-sm-9">
                                    <select class="select2 form-control custom-select" name="users" style="width: 50%; height:36px;">
                                        <option value="" disabled selected hidden>Veuillez choisir l'utilisateur </option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->email}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @can('Associer un profil et un compte')
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
