@extends('layouts.adminLayout.admin_design')

@section('title', 'LONACI::Administration')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Création des utilisateurs d'administration</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Administration</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Gestion des utilisateurs</li>
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
                        <a class="text-dark"href="{{route('add_user')}}">Créer un utilisateur</a>
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
            <div class="col-md-12">
                <div class="card">
                    <form class="form-horizontal" method="POST" action="{{ url('/admin/add_user') }}" name="add_user" id="add_user" novalidate="novalidate">
                        @csrf
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="card-body">
                            <style>
                                #firstname-error,#mdp-error,#mdpconf-error,#telephone-error , #lastname-error, #email-error{
                                    color: red;
                                }
                            </style>
                            <h4 class="card-title">Information utilisateurs</h4>

                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nom</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="firstname" name="firstname" value="{{old('firstname')}}" placeholder="Veuillez entrer votre nom">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="depart" class="col-sm-3 text-right control-label col-form-label" >Prénom</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="lastname" name="lastname" value="{{old('lastname')}}" placeholder="Veuillez rentrer votre prénom">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="depart" class="col-sm-3 text-right control-label col-form-label">Numéro de téléphone</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="telephone" name="telephone" value="{{old('telephone')}}" placeholder="Veuillez rentrer votre téléphone"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lname" class="col-sm-3 text-right control-label col-form-label">Adresse email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}"  placeholder="Veuillez entrer votre email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="depart" class="col-sm-3 text-right control-label col-form-label">Mot de passe</label>
                                <div class="col-sm-6">
                                     <input type="password" class="form-control mdp1 " id="mdp" name="mdp"  placeholder="Veuillez rentrer votre mot de passe" >
                                     <span class="show-password">afficher</span>
                                    
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="depart" class="col-sm-3 text-right control-label col-form-label mdp2">Confirmation de mot de passe</label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" id="mdpconf" name="mdpconf" placeholder="Veuillez confirmer votre mot de passe">
                                    <span class="show-password">afficher</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="depart" class="col-sm-3 text-right control-label col-form-label"> Profils</label>
                                <div class="col-sm-4">
                                   {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','')) !!}
                                </div>
                            </div>
                            @can('Créer utilisateur')
                                <div class="row card-body">
                                  <div class="col-sm-12">
                                    <div class="text-center">
                                       <button type="submit" class="btn btn-success text-dark center-block">Valider</button>
                                    </div>
                                  </div>
                                </div>
                           @endcan
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')

  <script>

    $(document).ready(function(){
 
            $('.show-password').click(function() {
                if($(this).prev('input').prop('type') == 'password') {
                   
                    $(this).prev('input').prop('type','text');
                    $(this).text('cacher');
                } else {
                    
                    $(this).prev('input').prop('type','password');
                    $(this).text('afficher');
                }
            });
 
        });
    </script>
  
@endsection
