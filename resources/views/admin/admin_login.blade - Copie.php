<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset("backendassets/images/favicon.png")}}">
    <title>Parions direct::Admin</title>
    <!-- Custom CSS -->
    <link href="{{asset("backenddist/css/style.min.css")}}"  rel="stylesheet">
     <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.32.4/sweetalert2.css" rel="stylesheet" />
    <link href="{{asset("css/app.css")}}"  rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <style>
       body{
            background: url("{{ asset("images/BgParionsDirect.png") }}");
            background-repeat: no-repeat;
            background-size: 100% 100%;
       }
       .show-password {
            cursor: pointer;
        }
        .picture{
           width:16px;
           height:16px;
        margin-top:15px;
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        @if(Session::has('flash_message_error'))
            <div class="alert alert-warning alert-block msg">
                <bouton type="button" class="close" data-dismiss="alert">x</bouton>
                <strong>{!! session('flash_message_error') !!}</strong>
            </div>
        @endif
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
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
            <div class="auth-box bg-dark border-top border-secondary">
                <div id="loginform">
                    <div class="text-center p-t-20 p-b-20">
                        <span class="db"><img src="{{asset("backendassets/images/logo.png")}}" alt="logo" /></span>
                    </div>
                    <br/>
                    <!-- Form -->
                    <form class="form-horizontal m-t-20" id="loginform" method="POST" action="{{ route('connexion') }}">
                        @csrf
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="row p-b-30">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="email" class="form-control form-control-lg" placeholder="Email" aria-label="Username" name="email" aria-describedby="basic-addon1" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}"  autofocus  required>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="fa fa-lock m-r-5"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" placeholder="Mot de passe" name="password"  aria-label="Password" aria-describedby="basic-addon1" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required >
                                   <!-- <span class="show-password" style="color:green">Afficher</span> -->
                                    <img class="show-password picture" src="{{asset("images/eyeClose.png")}}" alt="logo" />
                                </div>
                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20">
                                        <button class="btn btn-info" id="to-recover" type="button"><i class="ti-pencil"></i> Mot de passe oublié?</button>
                                        <button class="btn btn-success float-right" type="submit"><i class="ti-reload"></i>se connecter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="recoverform">
                    <div class="text-center">
                        <span class="text-black">
                    Entrez votre adresse e-mail ci-dessous et nous vous enverrons des instructions pour récupérer votre mot de passe.
                </span>
                    </div>
                    <div class="row m-t-20">
                        <!-- Form -->
                        <form class="col-12" method="POST" action="{{ route('email') }}">
                             @csrf
                            <!-- email -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="ti-email"></i></span>
                                </div>
                                <input type="email" name="email_msg" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} form-control-lg" placeholder="Adresse Email" value="{{ $email ?? old('email') }}" aria-label="Username" aria-describedby="basic-addon1" required>
                            </div>
                            <!-- pwd -->
                            <div class="row m-t-20 p-t-20 border-top border-secondary">
                                <div class="col-12">
                                    <a class="btn btn-success" href="#" id="to-login" name="action">Retour au login</a>
                                    <button class="btn btn-info float-right" type="submit" name="action">Récupérer</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->

    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="{{asset("backendassets/libs/jquery/dist/jquery.min.js")}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset("backendassets/libs/popper.js/dist/umd/popper.min.js")}}"></script>
    <script src="{{asset("backendassets/libs/bootstrap/dist/js/bootstrap.min.js")}}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.32.4/sweetalert2.all.js"></script>
    <script src="{{asset("js/app.js")}}"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>

    $(document).ready(function(){
         
        $('.show-password').click(function() {
            if($(this).prev('input').prop('type') == 'password') {
                //Si c'est un input type password
                $(this).prev('input').prop('type','text');
               /* $(this).text('Cacher').css("color", "red");*/
               
                $('.picture').attr('src', '{{asset("images/eye.png")}}');

                
            } else {
                //Sinon

               $(this).prev('input').prop('type','password');
                $('.picture').attr('src', '{{asset("images/eyeClose.png")}}');
                
            }
        });

    });

    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    // ==============================================================
    // Login and Recover Password
    // ==============================================================
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    $('#to-login').click(function(){
        $("#recoverform").hide();
        $("#loginform").fadeIn();
    });
    </script>
     @include('flashy::message')
     @include('sweet::alert')
</body>

</html>
