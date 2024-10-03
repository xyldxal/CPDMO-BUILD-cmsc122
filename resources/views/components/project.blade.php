<!DOCTYPE html>
<html>
<head>
    <title>Projects</title>
    <!-- Include necessary libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/project.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="mb-4 text-center">
            <h3 class="mb-2">All Projects</h3>
            <p>CPDMO BUILD</p>
        </div>

        <!-- Vue Component Mount Point -->
        <div id="app">
            <!-- Vue component to handle the table, pagination, search, and filters -->
            <progress-tracker 
                :initial-json="{{ json_encode($jsonFile) }}"
                :headers="{{ json_encode($projectHeaders) }}"
            ></progress-tracker>
        </div>
    </div>

    <!-- Include the app.js script -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
