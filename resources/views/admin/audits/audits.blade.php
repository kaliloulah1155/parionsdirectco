@extends('layouts.adminLayout.admin_design')

@section('title', 'LONACI::Administration')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Tracabilités des utilisateurs connectés</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Administration</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('audits')}}" style="color:black">Piste d'audits</a></li>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">tableaux de la piste d'audit</h5>
                        <div class="table-responsive">
                            <table id="zero_configAudit" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Utilisateur</th>
                                    <th>Action</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Heure</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($logaudits as $logaudit)
                                    <tr>
                                        <td>{{ $logaudit->utilisateur }}</td>
                                        <td>{{ $logaudit->action }}</td>
                                        <td>{{ $logaudit->type }}</td>
                                        <td>{{ $logaudit->dates }}</td>
                                        <td>{{ $logaudit->heures }}</td>
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
