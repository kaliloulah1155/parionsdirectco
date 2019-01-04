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
            <div class="col-12">
                <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">Liste des profils d'administration</h5>
                        <div class="table-responsive">
                            <table id="zero_config" class="zero_conf table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Intitulé</th>
                                    <th>Département</th>
                                    <th>Responsable</th>
                                    @role('super admin')
                                       <th>Status</th>
                                    @endrole
                                    <th style="text-align: center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                    <td>{{ $role->name }}</td> 
                                    <td>{{ $role->departement }}</td> 
                                    <td>{{ $role->responsable }}</td>  
                                    @role('super admin')
                                    <td>

                                                @if($role->status==0)
                                                    <b style="color: green" id="etat{{$role->id}}"  class="colors{{$role->id}}" >activé</b>
                                                @else
                                                    <b style="color:red" id="etat{{$role->id}}" class="colors{{$role->id}}" >desactivé</b>
                                                @endif
                                                <br/>
                                                <input type="hidden"  id="roleID{{$role->id}}" value="{{$role->id}}" />
                                                <select id="roleStatus{{$role->id}}" class="selroleID{{$role->id}}">
                                                    <option value="0">activé</option>
                                                    <option value="1">desactivé</option>
                                                </select>

                                    </td>
                                   @endrole
                                    <td style="text-align: center">
                                        @can('Modification de profil')
                                        <a  href="{{ URL::to('/admin/edit_role/'.$role->id) }}"  class="btn btn-cyan btn-sm mdi mdi-tooltip-edit" title="Modifier"></a>  |
                                        @endcan
                                        @can('Suppression de profil')
                                        <a   href="#" id="delProf{{$role->id}}" class="btn btn-danger btn-sm mdi mdi-delete deleteRole{{$role->id}}" title="Supprimer" ></a> |
                                        @endcan
                                        @can('Gestion des habilitations par profil')
                                        <a href="{{ URL::to('/admin/habilitation_role/'.$role->id) }}" class="btn btn-success btn-sm mdi mdi-account-switch" title="Habilitation"></a>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
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
            @foreach($roles as $role)
            $("#roleStatus{{$role->id}}").change(function(){
                var status=$("#roleStatus{{$role->id}}").val();
                var roleID=$("#roleID{{$role->id}}").val();
                $.ajax({
                    url:'{{url("admin/banRoles")}}',
                    data: 'status='+status+'&roleID='+roleID,
                    type: 'get',
                    success:function (response) {
                      
                        if(response==1){
                            $("#etat{{$role->id}}").html("desactivé").css("color", "red")
                        }else{
                            $("#etat{{$role->id}}").html("activé").css("color", "green")
                        }
                    }
                });
            });

            

            $(".deleteRole{{$role->id}}").click(function(){


                 @role('super admin')
                        window.location.href="{{ URL::to('/admin/delete_role/'.$role->id) }}"
                 @else
                      Swal({
                          title: 'Voulez-vous supprimer ?',
                          text: "Vous ne pourrez pas revenir en arrière!",
                          type: 'warning',
                          showCancelButton: true,
                          confirmButtonColor: '#3085d6',
                          cancelButtonColor: '#d33',
                          cancelButtonText: 'Annuler',
                          confirmButtonText: 'Supprimer'
                            }).then((result) => {
                              if (result.value) {
                                Swal(
                                  'Supprimé!',
                                  'Evénement effectué avec succès.',
                                  'success',
                                         window.location.href="{{ URL::to('/admin/delete_role/'.$role->id) }}"
                                )
                              }
                        });
                 @endrole

              });


            @endforeach

        });
    </script>
@stop
