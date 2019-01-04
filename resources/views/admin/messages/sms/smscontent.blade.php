@extends('layouts.adminLayout.admin_design')

@section('title', 'LONACI::Administration')
@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Message</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" >SMS</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('getsms')}}" style="color:black">Envoi de message</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- editor -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Envoi de SMS</h4>
                    <!-- Create the editor container -->
                    <hr/>
                    <form class="form-horizontal" method="POST" action="{{ url('/admin/getsmscontent') }}" id="formsms" novalidate="novalidate">
                        @csrf
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                            <label class="col-md-3 m-t-15">Numéro de Téléphone du destinataires</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <select class="form-control m-t-15" name="listgamers_data[]" multiple="multiple" style="height: 100px;width: 70%; ">
                                        <optgroup label="selectionnez un ou plusieurs numéros">
                                             @foreach($listgamers_data as $listgamers)
                                                <option value="{{ $listgamers->msisdn }}" >{{ $listgamers->msisdn }} | {{ $listgamers->firstname }} - {{ $listgamers->lastname }}</option>
                                             @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="titre" name="profil" value="" placeholder="Profil">
                                </div>
                                <div class="col-sm-3">
                                    <input type="hidden" class="form-control" id="titre" name="titre" value="" placeholder="Parions direct">
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label for="depart" class="col-sm-3 control-label col-form-label" >En-Tete du message</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="titre" name="titre" value="" placeholder="Parions direct">
                            </div>
                        </div>
                        
                         <!-- textarea -->
                        <div class="form-group">
                          <label>Corps du SMS</label>
                          <textarea rows="4" cols="50" name="textsms" class="form-control" rows="3" placeholder="Saisissez ..."></textarea>
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
