@extends('layouts.adminLayout.admin_design')
@section('title', 'LONACI::Administration')
@section('content')
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
			<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Dashboard</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Tableau de bord</a></li>
                                   {{--<li class="breadcrumb-item active" aria-current="page">Library</li> --}}
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->

            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Sales Cards  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Total</h4>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <!-- Column -->
                    <div class="col-md-4 col-lg-4 col-xlg-4">
                        <div class="card card-hover">
                            <div class="box text-center dshbrd1">
                                <i class="icon fa fa-users fa-3x text-white"></i>
                                <h1 class="font-light text-white">Nombre de paris pris</h1>
                                <h1 class="badge"  style="background-color: white; font-size: large; color: #298A08; font-weight: bold">({{$totalTicket}})</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->

                     <!-- Column -->
                    <div class="col-md-4 col-lg-4 col-xlg-4">
                        <div class="card card-hover">
                            <div class="box text-center dshbrd2" >
                                <i class="icon far fa-money-bill-alt fa-3x text-white"></i>
                                <h1 class="font-light text-white">Chiffre d'affaires</h1>
                                <h1 class="badge" style="background-color: white; font-size: large; color: #FF8000; font-weight: bold">({{$totalMnt}} fcfa)</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box text-center dshbrd1" >
                                <i class="icon far fa-money-bill-alt fa-3x text-white" ></i>
                                <h1 class="font-light text-white">Montant de tickets gagnants</h1>
                                <h1 class="badge" style="background-color: white; font-size: large; color: #298A08; font-weight: bold">( {{$mntgagnant}} fcfa)</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->

                </div>
                <hr/>
                <div class="row">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Jeux digitaux</h4>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <!-- Column -->
                    <div class="col-md-4 col-lg-4 col-xlg-4">
                        <div class="card card-hover">
                            <div class="box text-center dshbrd1">
                                <i class="icon fa fa-users fa-3x text-white"></i>
                                <h1 class="font-light text-white">Nombre de paris pris</h1>
                                <h1 class="badge"  style="background-color: white; font-size: large; color: #298A08; font-weight: bold">(0)</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->

                    <!-- Column -->
                    <div class="col-md-4 col-lg-4 col-xlg-4">
                        <div class="card card-hover">
                            <div class="box text-center dshbrd2" >
                                <i class="icon far fa-money-bill-alt fa-3x text-white"></i>
                                <h1 class="font-light text-white">Chiffre d'affaires</h1>
                                <h1 class="badge" style="background-color: white; font-size: large; color: #FF8000; font-weight: bold">(000 000 fcfa)</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box text-center dshbrd1" >
                                <i class="icon far fa-money-bill-alt fa-3x text-white" ></i>
                                <h1 class="font-light text-white">Montant de tickets gagnants</h1>
                                <h1 class="badge" style="background-color: white; font-size: large; color: #298A08; font-weight: bold">(0 000 000 fcfa)</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->

                </div>
                <hr/>
                <div class="row">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Loto bonheur</h4>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <!-- Column -->
                    <div class="col-md-4 col-lg-4 col-xlg-4">
                        <div class="card card-hover">
                            <div class="box text-center dshbrd1">
                                <i class="icon fa fa-users fa-3x text-white"></i>
                                <h1 class="font-light text-white">Nombre de paris pris</h1>
                                <h1 class="badge"  style="background-color: white; font-size: large; color: #298A08; font-weight: bold">({{$totalLotoTicket}})</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->

                    <!-- Column -->
                    <div class="col-md-4 col-lg-4 col-xlg-4">
                        <div class="card card-hover">
                            <div class="box text-center dshbrd2" >
                                <i class="icon far fa-money-bill-alt fa-3x text-white"></i>
                                <h1 class="font-light text-white">Chiffre d'affaires</h1>
                                <h1 class="badge" style="background-color: white; font-size: large; color: #FF8000; font-weight: bold">( {{$totalLotoMnt}} fcfa)</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                   
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box text-center dshbrd1" >
                                <i class="icon far fa-money-bill-alt fa-3x text-white" ></i>
                                <h1 class="font-light text-white">Montant de tickets gagnants</h1>
                                <h1 class="badge" style="background-color: white; font-size: large; color: #298A08; font-weight: bold">({{$mntgagnantLoto}} fcfa)</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->

                </div>
                <hr/>
                <div class="row">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">PMU ALR</h4>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <!-- Column -->
                    <div class="col-md-4 col-lg-4 col-xlg-4">
                        <div class="card card-hover">
                            <div class="box text-center dshbrd1">
                                <i class="icon fa fa-users fa-3x text-white"></i>
                                <h1 class="font-light text-white">Nombre de paris pris</h1>
                                <h1 class="badge"  style="background-color: white; font-size: large; color: #298A08; font-weight: bold">({{$totalAlrTicket}})</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->

                    <!-- Column -->
                    <div class="col-md-4 col-lg-4 col-xlg-4">
                        <div class="card card-hover">
                            <div class="box text-center dshbrd2" >
                                <i class="icon far fa-money-bill-alt fa-3x text-white"></i>
                                <h1 class="font-light text-white">Chiffre d'affaires</h1>
                                <h1 class="badge" style="background-color: white; font-size: large; color: #FF8000; font-weight: bold">({{$totalAlrMnt}} fcfa)</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box text-center dshbrd1" >
                                <i class="icon far fa-money-bill-alt fa-3x text-white" ></i>
                                <h1 class="font-light text-white">Montant de tickets gagnants</h1>
                                <h1 class="badge" style="background-color: white; font-size: large; color: #298A08; font-weight: bold">({{$mntgagnantAlr}} fcfa)</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->

                </div>
                <hr/>
                <div class="row">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">PMU PLR</h4>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <!-- Column -->
                    <div class="col-md-4 col-lg-4 col-xlg-4">
                        <div class="card card-hover">
                            <div class="box text-center dshbrd1">
                                <i class="icon fa fa-users fa-3x text-white"></i>
                                <h1 class="font-light text-white">Nombre de paris pris</h1>
                                <h1 class="badge"  style="background-color: white; font-size: large; color: #298A08; font-weight: bold">({{$totalPlrTicket}})</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->

                    <!-- Column -->
                    <div class="col-md-4 col-lg-4 col-xlg-4">
                        <div class="card card-hover">
                            <div class="box text-center dshbrd2" >
                                <i class="icon far fa-money-bill-alt fa-3x text-white"></i>
                                <h1 class="font-light text-white">Chiffre d'affaires</h1>
                                <h1 class="badge" style="background-color: white; font-size: large; color: #FF8000; font-weight: bold">({{$totalPlrMnt}} fcfa)</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box text-center dshbrd1" >
                                <i class="icon far fa-money-bill-alt fa-3x text-white" ></i>
                                <h1 class="font-light text-white">Montant de tickets gagnants</h1>
                                <h1 class="badge" style="background-color: white; font-size: large; color: #298A08; font-weight: bold">({{$mntgagnantPlr}} fcfa)</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->

                </div>
                <hr/>
                <div class="row">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">SPORTCASH</h4>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <!-- Column -->
                    <div class="col-md-4 col-lg-4 col-xlg-4">
                        <div class="card card-hover">
                            <div class="box text-center dshbrd1">
                                <i class="icon fa fa-users fa-3x text-white"></i>
                                <h1 class="font-light text-white">Nombre de paris pris</h1>
                                <h1 class="badge"  style="background-color: white; font-size: large; color: #298A08; font-weight: bold">({{$totalSportcashTicket}})</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->

                    <!-- Column -->
                    <div class="col-md-4 col-lg-4 col-xlg-4">
                        <div class="card card-hover">
                            <div class="box text-center dshbrd2" >
                                <i class="icon far fa-money-bill-alt fa-3x text-white"></i>
                                <h1 class="font-light text-white">Chiffre d'affaires</h1>
                                <h1 class="badge" style="background-color: white; font-size: large; color: #FF8000; font-weight: bold">({{$totalSportcashMnt}} fcfa)</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box text-center dshbrd1" >
                                <i class="icon far fa-money-bill-alt fa-3x text-white" ></i>
                                <h1 class="font-light text-white">Montant de tickets gagnants</h1>
                                <h1 class="badge" style="background-color: white; font-size: large; color: #298A08; font-weight: bold">({{$mntgagnantSportcash}} fcfa)</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->

                </div>
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- Sales chart -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
@endsection
