@extends('layouts.adminLayout.admin_design')

@section('title', 'LONACI::Administration')
@section('content')


    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Liste des utilisateurs</h4>
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
            @can('Créer utilisateur')
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <div class="card card-hover">
                    <div class="box  text-center">
                        <h1 class="font-light text-black"><i class="mdi mdi-account-circle"></i></h1>
                        <a class="text-dark" href="{{route('add_user')}}">Créer un utilisateur</a>
                    </div>
                </div>
            </div>
           @endcan
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
                        <h5 class="card-title">Liste des utilisateurs</h5>
                        <div class="table-responsive">

                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Profil</th>
                                    <th>Noms</th>
                                    <th>Prénoms</th>
                                    <th>Téléphone</th>
                                    <th>emails</th>
                                    <th style="text-align: center">infos</th>
                                    <th style="text-align: center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key => $user)
                                    <tr>
                                        <td>
                                            @if(!empty($user->getRoleNames()))
                                                @foreach($user->getRoleNames() as $v)
                                                    <label class="badge badge-success">{{ $v }}</label>
                                                @endforeach
                                            @endif
                                        </td>
                                    <td>{{ $user->firstname }}</td> 
                                    <td>{{ $user->lastname }}</td> 
                                     <td>{{ $user->phone_number }}</td> 
                                    <td>{{ $user->email }}</td>  
                                    <td>Créé le  {{   $user->created_at  }}</td>
                                    <td style="text-align: center">
                                        @can("Modifier utilisateur")
                                        <a  href="{{ URL::to('/admin/edit_user/'.$user->id) }}"  class="btn btn-cyan btn-sm mdi mdi-tooltip-edit" title="Modifier"></a>  |
                                        @endcan
                                        @can("Supprimer utilisateur")
                                        <a  href="#"  class="btn btn-danger btn-sm mdi mdi-delete deleteUser{{$user->id}}" title="Supprimer" ></a> |
                                       @endcan
                                       @can('Infos utilisateur')
                                        <a href="{{ URL::to('/admin/detail_user/'.$user->id) }}" class="btn btn-success btn-sm mdi mdi-account-settings" title="Détail"></a>
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
            @foreach($data as $key => $user)
            
            $(".deleteUser{{$user->id}}").click(function(){
                
                     @role('super admin')
                        window.location.href="{{ URL::to('/admin/delete_user/'.$user->id) }}"
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
                                             window.location.href="{{ URL::to('/admin/delete_user/'.$user->id) }}"
                                    )
                                  }
                            });
                    @endrole

              });
              
            @endforeach

        });
    </script>
@stop