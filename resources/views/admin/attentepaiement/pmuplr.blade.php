@extends('layouts.adminLayout.admin_design')

@section('title', 'LONACI::Administration')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Liste des PMU PLR</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Liste des tickets pris</a></li>
                            <li class="breadcrumb-item active" aria-current="page">PMU PLR</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
         <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form class="form-horizontal" action="#" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="card-body">
                            <h4 class="card-title">Formulaire de recherche</h4>
                            <div class="form-group row ">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Date de début</label>
                                <div class="col-sm-2 input-group date">
                                    <input type="text" class="form-control debutdatepicker" name="rq_dt_debut" placeholder="mm/dd/yyyy">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lname" class="col-sm-3 text-right control-label col-form-label">Date de fin</label>
                                <div class="col-sm-2 input-group date">
                                    <input type="text" class="form-control findatepicker" name="rq_dt_fin" placeholder="mm/dd/yyyy">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lname" class="col-sm-3 text-right control-label col-form-label">Statut</label>
                                <div class="col-sm-4">
                                    <select class="select2 form-control custom-select" name="rq_statut" style="width: 100%; height:36px;">
                                        <option disabled selected hidden value="{{old('url')}}">Veuillez choisir le statut</option>
                                        <option value="En cours">En cours</option>
                                        <option value="Annulé">Annulé</option>
                                        <option value="Perdant">Perdant</option>
                                        <option value="Gagnant">Gagnant</option>
                                        <option value="Remboursé">Remboursé</option>
                                        <option value="Vainqueur en attente de paiement">Vainqueur en attente de paiement</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lname" class="col-sm-3 text-right control-label col-form-label">Montant minimum de gains</label>
                                <div class="col-sm-4 input-group date">
                                    <input type="text" class="form-control" id="mtn" name="rq_min_mnt" placeholder="Veuillez entrer le montant minimum">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-euro-sign"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lname" class="col-sm-3 text-right control-label col-form-label">Montant maximum de gains</label>
                                <div class="col-sm-4 input-group date">
                                    <input type="text" class="form-control" id="mtn" name="rq_max_mnt"  placeholder="Veuillez entrer le montant maximum">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-euro-sign"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row card-body">
                              <div class="col-sm-12">
                                <div class="text-center">
                                   <button type="submit" class="btn btn-info">Recherche</button>
                                </div>
                              </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="border-top">
                        <div class="card-body">
                            <a  href="{{route('exportex')}}"  class="btn btn-danger">EXPORTER</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Liste des paris pmu plr </h5>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Statut</th>
                                    <th style="text-align: center">N° de référence</th>
                                    <th style="text-align: center">N° de ticket</th>
                                    <th style="text-align: center">N° de Transaction</th>
                                    <th style="text-align: center">Montant du pari</th>
                                    <th style="text-align: center">Mise</th>
                                    <th style="text-align: center">Détails</th>
                                    <th style="text-align: center">Actions</th>

                                </tr>
                                </thead>
                                <tbody>
                               
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
