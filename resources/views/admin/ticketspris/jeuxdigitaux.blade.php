@extends('layouts.adminLayout.admin_design')

@section('title', 'LONACI::Administration')
@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Liste des jeux digitaux</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Liste des tickets pris</a></li>
                            <li class="breadcrumb-item active" aria-current="page">jeux digitaux</li>
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
                    <form class="form-horizontal" action="{{route('jeuxdigitaux')}}" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="card-body">
                            <h4 class="card-title">Formulaire de recherche</h4>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Date de début</label>
                                <div class="col-sm-2 input-group date">
                                    <input type="text" class="form-control debutdatepicker" name="rq_dt_debut"  placeholder="mm/dd/yyyy">
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
                                <div class="col-sm-3">
                                    <select class="select2 form-control custom-select" name="rq_statut" style="width: 100%; height:36px;">
                                        <option disabled selected hidden>Veuillez choisir le statut</option>
                                                <option value="En cours">En cours</option>
                                                <option value="Annulé">Annulé</option>
                                                <option value="Perdant">Perdant</option>
                                                <option value="Gagnant">Gagnant</option>
                                                <option value="Remboursé">Remboursé</option>
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
                                    <input type="text" class="form-control" id="mtn" name="rq_max_mnt" placeholder="Veuillez entrer le montant maximum">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-euro-sign"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-info">Recherche</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Statistiques relatives aux jeux digitaux </h5>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Statut</th>
                                    <th style="text-align: center">Nombre de paris</th>
                                    <th style="text-align: center">Chiffre d'affaires</th>
                                    <th style="text-align: center">Montant des annulations</th>
                                    <th style="text-align: center">Montant des gains</th>
                                    <th style="text-align: center">Montant des remboursements</th>
                                </tr>
                                </thead>
                                <tbody>
                                 <tr>
                                        <td style="text-align: center">En cours</td>
                                        <td style="text-align: center">{{ $encours }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">Annulé</td>
                                        <td style="text-align: center">{{ $annuler }}</td>
                                        <td></td>
                                        <td style="text-align: center">{{ $montantannuler }}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">Perdant</td>
                                        <td style="text-align: center">{{ $perdu }}</td>
                                        <td style="text-align: center">{{ $montantperdu}}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">Gagnant</td>
                                        <td style="text-align: center">{{ $gagnant }}</td>
                                        <td style="text-align: center">{{ $montantgagnant }}</td>
                                        <td></td>
                                        <td style="text-align: center">{{ $montantdugagnant }}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">Remboursé</td>
                                        <td style="text-align: center">{{ $rembourser }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Statistiques relatives aux jeux digitaux </h5>
                        <div class="table-responsive">
                            <table id="zero_config1" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th style="text-align: center">Statut</th>
                                    <th style="text-align: center">N° de réference</th>
                                    <th style="text-align: center">N° de ticket</th>
                                    <th style="text-align: center">N° de transaction</th>
                                    <th style="text-align: center">Montant du paris</th>
                                    <th style="text-align: center">Date </th>
                                    <th style="text-align: center">Détails</th>
                                </tr>
                                </thead>
                                <tbody>
                              
                                    @if(!empty($response_eppl_data))
                                            @foreach ($response_eppl_data as $list)
                                             @if(!empty($list->bet_status))  
                                                <tr>
                                                    <td>{{ $list->bet_status }}</td>
                                                    <td>{{ $list->game_id }}</td>
                                                    <td>{{ $list->ticket_id }}</td>
                                                    <td>{{ $list->transaction_id}}</td>
                                                    <td>{{ $list->transaction_amount}}</td>
                                                    <td>{{  (new DateTime($list->created_at))->format('d/m/Y à h\h:i\m\n ') }}</td>
                                                    <td style="text-align: center">
                                                        @if($list->bet_status=="Vainqueur en attente de paiement")
                                                         <!--    <label class="checkbox-inline"> Valider paiement</label> -->
                                                             <div class="checkbox">
                                                                    <input type="checkbox" name="valid"  id="valid{{$list->transaction_id}}"  class="cvalid{{$list->transaction_id}}" data-toggle="toggle" data-size="mini" >

                                                             </div>
                                                             <hr/>
                                                        @endif
                                                        <a  href="{{ URL::to('/admin/detailseppl/'.$list->transaction_id) }}"  class="btn btn-cyan btn-sm  mdi mdi-account-star-variant" title="Détails"></a>
                                                    </td>
                                                 </tr>
                                            @endif
                                        @endforeach

                                     @else

                                        @foreach ($listDatEppl as $list)
                                             @if(!empty($list->bet_status))  
                                                <tr>
                                                    <td>{{ $list->bet_status }}</td>
                                                    <td>{{ $list->game_id }}</td>
                                                    <td>{{ $list->ticket_id }}</td>
                                                    <td>{{ $list->transaction_id}}</td>
                                                    <td>{{ $list->transaction_amount}}</td>
                                                    <td>{{  (new DateTime($list->created_at))->format('d/m/Y à h\h:i\m\n ') }}</td>
                                                   
                                                    <td style="text-align: center">
                                                        @if($list->bet_status=="Vainqueur en attente de paiement")
                                                         <!--    <label class="checkbox-inline"> Valider paiement</label> -->
                                                             <div class="checkbox">
                                                                    <input type="checkbox" name="valid"  id="valid{{$list->transaction_id}}"  class="cvalid{{$list->transaction_id}}" data-toggle="toggle" data-size="mini" >

                                                             </div>
                                                             <hr/>
                                                        @endif
                                                        <a  href="{{ URL::to('/admin/detailseppl/'.$list->transaction_id) }}"  class="btn btn-cyan btn-sm  mdi mdi-account-star-variant" title="Détails"></a>
                                                    </td>
                                                 </tr>
                                            @endif
                                        @endforeach

                                     @endif
                              
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
    <script>
          $(document).ready(function(){

             @foreach ($listDatEppl as $list)
             
               $('#valid{{$list->transaction_id}}').bootstrapToggle('destroy').bootstrapToggle({
                    on: 'valide',
                    off: 'invalide',
                    onstyle:'success',
                    offstyle:'danger',
               });
                $('#valid{{$list->transaction_id}}').change( function(){
                      var status= $(this).prop('checked');
                      var transaction_id=<?php echo  json_encode($list->transaction_id); ?>;
                      
                      $.ajax({
                                url:'{{url("admin/waitWinEppl")}}',
                                data: 'status='+status+'&transaction_id='+transaction_id,
                                type: 'get',
                                success:function (response) {
                                  
                                    if(response==1){
                                        console.log(status);
                                    }else{
                                        console.log(status);
                                    }
                                }
                        });
                });
              

              @endforeach

         });
    </script>
   
@stop
