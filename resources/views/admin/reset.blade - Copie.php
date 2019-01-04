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
    <title>Parions direct::Reset</title>
    <!-- Custom CSS -->
    <link href="{{asset("backenddist/css/style.min.css")}}"  rel="stylesheet">
   <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.32.4/sweetalert2.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries jjj -->
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
            <div class="alert alert-warning alert-block">
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
                <div>
                    <div class="text-center p-t-20 p-b-20">
                        <span class="db text-black text-uppercase">Réinitialisation de mot de passe</span>
                    </div>
                    <!-- Form -->
                    <form class="form-horizontal m-t-20" method="POST" action="{{ route('resetPassword') }}">
                        @csrf
                        <div class="row p-b-30">
                            <div class="col-12">
                                <!-- email -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="ti-email"></i></span>
                                    </div>
                                    <input type="email" class="form-control form-control-lg" placeholder="Adresse email" name="email" aria-label="Username" aria-describedby="basic-addon1" value="{{ old('email') }}" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" placeholder="Mot de passe" name="password"  aria-label="Password" aria-describedby="basic-addon1" required>
                                    
                                     <img class="show-password picture" src="{{asset("images/eyeClose.png")}}" alt="logo" />
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-info text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" placeholder="Confirmez mot de passe" name="password_confirmation" aria-label="Password" aria-describedby="basic-addon1" required>
                                      <img class="show-password picture" src="{{asset("images/eyeClose.png")}}" alt="logo" />
                                </div>
                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20">
                                        <button class="btn btn-block btn-lg btn-info" type="submit">Valider</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="{{asset("backendassets/libs/jquery/dist/jquery.min.js")}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset("backendassets/libs/popper.js/dist/umd/popper.min.js")}}"></script>
    <script src="{{asset("backendassets/libs/bootstrap/dist/js/bootstrap.min.js")}}"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.32.4/sweetalert2.all.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>

      $(document).ready(function(){

        $('.show-password').click(function() {
            if($(this).prev('input').prop('type') == 'password') {
                //Si c'est un input type password
                $(this).prev('input').prop('type','text');
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

</body>

</html>