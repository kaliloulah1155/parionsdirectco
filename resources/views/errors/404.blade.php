@extends('errors::layout')

@section('title','page 404')
@section('message')
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="error-box1">
            <div class="error-body text-center">
                <h1 class="error-title text-danger" style="font-size:200px;">404</h1>
                <h3 class="text-uppercase error-subtitle">PAGE INTROUVABLE !</h3>
                <p class="text-muted m-t-30 m-b-30">VOUS ESSAYEZ DE TROUVER UNE INFORMATION INEXISTANTE</p>
                <a href="{{ route('index') }}" class="btn btn-danger btn-rounded waves-effect waves-light m-b-40">Retour à la page d'accueil</a> </div>
        </div>
    </div>
@endsection