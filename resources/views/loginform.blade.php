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
    <div></div>
    <section class="container">
        <div class="d-flex flex-column justify-content-center align-items-center" style="height: 100vh;">
            
            <!-- Titles -->
            <div class="text-center mb-4">
                <h1 class="title mb-2">BUILD&#x2122;</h1>
                <h2 class="subhead">Build Updates and Infrastructure Listings Database</h2>
            </div>
            
            <!-- Card -->
            <div class="card-container card p-4">
                <div class="card-body">
                    <h2 class="subtitle text-center mb-4">Log In</h2>
                    <form method="POST" action="/testform">
                        @csrf
                        <div class="form-group">
                            <input id="email" name="email" type="email" class="form-control input-field" placeholder="Email" required>
                        </div>
                        <div class="form-group position-relative">
                            <input id="password" name="password" type="password" class="form-control input-field" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <div class="form-options d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check mb-0">
                                <input type="checkbox" class="form-check-input" id="rememberMe" checked>
                                <label class="form-check-label small" for="rememberMe">Remember Me</label>
                            </div>
                            <a href="#" class="forgot-password small">Forgot Password</a>
                        </div>
                        
                    </form>
                    <p class="divider text-center">— Or Sign In With —</p>
                    <div class="social-login text-center">
                        <a href="/auth/google/redirect" class="btn btn-primary btn-block google-login d-flex align-items-center justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google mr-2" viewBox="0 0 16 16">
                                <path d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z"/>
                            </svg> Google SSO
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
</body>
</html>
