<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/loginpage.css') }}">
</head>
<body>
    <div class="container-fluid h-100">
        <div class="row no-gutters">
            <div class="login-content text-center">
                <img src="{{ asset('images/buildtemp1.png') }}" alt="BUILD Logo" class="mb-3" style="width: 200px;">
                <h5 class="text-uppercase mb-4">Build Updates and Infrastructure Listings Database</h5>
                <div class="green-divider"></div>
                <h2 class="mb-4">Log In</h2>
                
                <div class="login-form">
                    <form method="POST" action="/testform">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        
                        <div class="form-options d-flex justify-content-between align-items-center my-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember Me</label>
                            </div>
                            <a href="#" class="forgot-link">Forgot Password</a>
                        </div>
                        
                        <div class="divider">
                            <span>or</span>
                        </div>
                        
                        <a href="/auth/google/redirect" class="btn btn-light btn-block google-btn">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Google_%22G%22_logo.svg/2048px-Google_%22G%22_logo.svg.png" alt="Google Logo" class="google-icon">
                            Continue with Google
                        </a>
                    </form>
                </div>
            </div>
            
            <!-- Right side with background image -->
            <div class="col-lg-6 d-none d-lg-block">
                <div class="bg-image h-100" style="background: url('{{ asset('images/background 1.png') }}') center no-repeat;"></div>
            </div>
        </div>
    </div>
</body>
</html>
