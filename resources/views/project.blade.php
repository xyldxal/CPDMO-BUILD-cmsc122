<!doctype html>
<html lang="en">
<head>
<title>Home</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/nav-bar.css') }}">

<!-- <link rel="stylesheet" href="{{ asset('css/login.css') }}"> -->
<script>
    function logout() {
        window.location.href = '/logout';
    }
</script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-0 py-3">
    <div class="container-xl">
        <!-- Logo -->
        <!-- <a class="navbar-brand" href="#">
        <img src="https://preview.webpixels.io/web/img/logos/clever-light.svg" class="h-8" alt="...">
        </a> -->
        <a class="navbar-brand" href="#">CPDMO BUILD</a>
        <!-- Navbar toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
        <!-- Nav -->
        <div class="navbar-nav mx-lg-auto">
            <a class="nav-item nav-link active" href="#" aria-current="page">Project Progress Tracker</a>
            <a class="nav-item nav-link" href="#">Projects</a>
            <a class="nav-item nav-link" href="#">Completed</a>
            <a class="nav-item nav-link" href="#">Construction</a>
            <a class="nav-item nav-link" href="#">Delayed</a>
            <a class="nav-item nav-link" href="#">Terminated</a>
        </div>
        <!-- Right navigation -->
        <!-- <div class="navbar-nav ms-lg-4">
            <a class="nav-item nav-link" href="/logout">Logout</a>
        </div> -->
        <div class="logout navbar-nav ms-lg-4">
            <button onclick="logout()" class="btn btn-outline-light">LOGOUT</button>
        </div>
        <!-- Action -->
        <!-- <div class="d-flex align-items-lg-center mt-3 mt-lg-0">
            <a href="#" class="btn btn-sm btn-primary w-full w-lg-auto">
            Register
            </a>
        </div> -->
        </div>
    </div>
    </nav>

    <div class="p-10 bg-surface-secondary">
    <div class="mb-8 text-center">
        <h3 class="mb-2">Crafted with <a href="https://github.com/webpixels/css" target="_blank">Webpixels CSS</a></h3>
        <p>The design system for Bootstrap 5</p>
    </div>
    <div class="mt-8 text-center">
        <a href="https://webpixels.io/components?ref=codepen" class="text-warning" target="_blank">Browse all components -></a>
    </div>
    </div>
        
    <!-- {{ $project_trackers }} -->
    <!-- <div class="container"> -->
    <!-- <a><b>project_tracker_1:</b> {{ $projects->keys()->first() }}</a>
    <a><b>project_trackers:</b> {{ $project_trackers }}</a>
    <a><b>tracker_columns:</b> {{ implode(', ', $tracker_columns) }}</a>
    <a><b>projects:</b> {{ $projects }}</a>
    <a><b>projects_columns:</b> {{ implode(', ', $projects_columns) }}</a> -->


    <div class="table-responsive">
        <table id="newProjects" class="table table-striped">
        <thead>
            <tr>
                @foreach ($tracker_columns as $column)
                    <th scope="col">{{ $column }}</th>
                    <!-- @if($column = "status")
                        @foreach ($projects_columns as $pindex => $pcolumn)
                            <th scope="col">{{ $pindex }} : {{ $pcolumn }}</th>
                        @endforeach
                    @endif -->
                @endforeach

                
            </tr>
        </thead>
        <tbody>
            @foreach ($project_trackers as $tracker)
                <tr>
                    @foreach ($tracker_columns as $column)
                        <td scope="row">{{ $tracker->$column }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
        <!-- <tbody>
            @foreach ($project_trackers as $index => $tracker)
                <tr>
                    @foreach ($tracker_columns as $index => $column)
                        <td scope="row">{{ $tracker->$column }}</td>
                        @if($index = "status")
                            @foreach ($project_trackers->where('tracking_number', $tracker->tracking_number) as $contractor)
                                <td scope="row">{{ $tracker->$column }}</td>
                            @endforeach
                        @endif
                    @endforeach
                    
                </tr>
            @endforeach
        </tbody> -->
        </table>
    </div>
    
</body>