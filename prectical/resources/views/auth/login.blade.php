
<!DOCTYPE html>
<html lang="en" class="h-100">


<!-- Mirrored from demo.themefisher.com/dlab/light/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Mar 2021 07:15:24 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Spin & Wheel</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="css/style.css" rel="stylesheet">
    
</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <!-- <div class="col-md-10"> -->
                    <!-- <div class="authincation-content"> -->
                        <!-- <div class="row no-gutters"> -->
                            <!-- <div class="col-xl-6">
                                <div class="welcome-content">
                                    <div class="brand-logo">
                                        <a href="index.html">Spin & Wheel</a>
                                    </div>
                                    <h3 class="welcome-title">Welcome to Spin & Wheel</h3>
                                    
                                </div>
                            </div> -->

                            <div class="card col-xl-6 ">
                                 <div class="auth-form">
                                    <div class="row">
                                <!-- <div class="header"> -->
                                 <img src="{{asset('images/spin.png')}}" alt="logo" width="150" height="100" style="display: block;margin-left: auto; margin-right: auto; width: 50%;">
                                 </div>
                                    <div class="font-weight-bold" style="font-size: 18px; text-align: center; margin-bottom: 5px;">Sign in your account</div>
                                
                                    <!-- <h4 class="text-center mb-4">Sign in your account</h4> -->
                                    <!-- </div> -->
                                    <form action="{{ route('login') }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                              <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                     <div class="input-group-text"><i class="fa fa-user" style="color: black;"></i></div>
                                                 </div>
                                            <!-- <label><strong>Email</strong></label> -->
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                                        </div>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <!-- <label><strong>Password</strong></label> -->
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                     <div class="input-group-text"><i class="fa fa-key" style="color: black;"></i></div>
                                                 </div>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                        </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                        </div>
                                      
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-lg">Login</button>
                                        </div>
                                    </form>
                                   <!--  <div class="new-account mt-3">
                                        <p>Don't have an account? <a class="text-primary" href="{{ route('register') }}">Sign up</a></p>
                                    </div> -->
                                </div>
                            </div>
                        <!-- </div> -->
                    <!-- </div> -->
                <!-- </div> -->
            </div>
        </div>
    </div>
</body>

    
<!-- Mirrored from demo.themefisher.com/dlab/light/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Mar 2021 07:15:25 GMT -->
</html>
