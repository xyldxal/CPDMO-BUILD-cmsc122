{{-- <link rel="stylesheet" href="{{ asset('css/nav-bar.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/login.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('css/global.css') }}">
<link rel="stylesheet" href="{{ asset('css/header.css') }}">

<style>
    .container-xl {
        max-width: 100%;
    }
    .navbar {
        padding-top: 0.2rem;
        padding-bottom: 0.2rem;
    }
    .main-wrapper {
        min-height: 89vh;
    }
</style>

<script>

    document.addEventListener('DOMContentLoaded', function() {

        function getStoredValue(key) {
            if (localStorage) {
                return localStorage.getItem(key);
            } else {
                return $.cookies.get(key);
            }
        }
        
        if(getStoredValue('component')){
            // console.log('nav-'.concat(getStoredValue('component')));
            document.getElementById('nav-'.concat(getStoredValue('component'))).classList.add('active');
        } else {
            document.getElementById('nav-ovcpd-progress-tracker').classList.add('active');
        }

        // console.log(getStoredValue('component'));

        // Get all navigation links
        const navLinks = document.querySelectorAll('.nav-item.nav-link');

        // Add click event listener to each navigation link
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                // Remove "active" class from all links
                navLinks.forEach(navLink => navLink.classList.remove('active'));
                // Add "active" class to the clicked link
                link.classList.add('active');
            });
        });
        document.getElementById('nav-dashboard').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent page reload
            window.dispatchEvent(new CustomEvent('displayComponent', { detail: { component: 'dashboard' } }));
        });
        document.getElementById('nav-ovcpd-progress-tracker').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent page reload
            // Emit an event with the component name
            window.dispatchEvent(new CustomEvent('displayComponent', { detail: { component: 'ovcpd-progress-tracker' } }));
            // storeValue('component', 'ovcpd-progress-tracker');
        });
        document.getElementById('nav-ovcpd-master-plan').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent page reload
            // Emit an event with the component name
            window.dispatchEvent(new CustomEvent('displayComponent', { detail: { component: 'ovcpd-master-plan' } }));
        });
        document.getElementById('nav-project').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent page reload
            window.dispatchEvent(new CustomEvent('displayComponent', { detail: { component: 'project' } }));
            // storeValue('component', 'project');
        });
        document.getElementById('nav-completed').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent page reload
            window.dispatchEvent(new CustomEvent('displayComponent', { detail: { component: 'completed' } }));
        });
        document.getElementById('nav-construction').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent page reload
            window.dispatchEvent(new CustomEvent('displayComponent', { detail: { component: 'construction' } }));
        });
        document.getElementById('nav-delayed').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent page reload
            window.dispatchEvent(new CustomEvent('displayComponent', { detail: { component: 'delayed' } }));
        });
        document.getElementById('nav-terminated').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent page reload
            window.dispatchEvent(new CustomEvent('displayComponent', { detail: { component: 'terminated' } }));
        });
        document.getElementById('nav-about').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent page reload
            window.dispatchEvent(new CustomEvent('displayComponent', { detail: { component: 'about' } }));
        });
    });

    function logout() {
        window.location.href = '/logout';
    }

    // function storeValue(key, value) {
    //     if (sessionStorage) {
    //         sessionStorage.setItem(key, value);
    //     } else {
    //         $.cookies.set(key, value);
    //     }
    // }

    // function getStoredValue(key) {
    //     if (sessionStorage) {
    //         return sessionStorage.getItem(key);
    //     } else {
    //         return $.cookies.get(key);
    //     }
    // }
    
</script>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-0">
    <div class="container-xl">
        <div class="d-flex align-items-center me-auto">
            <img src="{{ asset('images/build-logo.png') }}" style="margin-right: 10px;" alt="BUILD" width="45" height="45" class="up-logo d-inline-block align-top">
            <a class="navbar-brand fs-5" href="#">BUILD</a>
        </div>
        <!-- Navbar toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
        <!-- Nav -->
            <div class="navbar-nav me-auto fs-6">
                <a id='nav-dashboard' class="nav-item nav-link" href="#">Dashboard</a>
                <a id='nav-ovcpd-progress-tracker' class="nav-item nav-link" href="#" aria-current="page">Progress Tracker</a>
                <a id='nav-ovcpd-master-plan' class="nav-item nav-link" href="#">Planning</a>
                <a id='nav-project' class="nav-item nav-link" href="#">Projects</a>
                <a id='nav-completed' class="nav-item nav-link" href="#" hidden>Completed</a>
                <a id='nav-construction' class="nav-item nav-link" href="#" hidden>Construction</a>
                <a id='nav-delayed' class="nav-item nav-link" href="#" hidden>Delayed</a>
                <a id='nav-terminated' class="nav-item nav-link" href="#" hidden>Terminated</a>
                <a id='nav-about' class="nav-item nav-link" href="#">ABOUT</a>
            </div>
            <div class="logout navbar-nav ms-lg-4">
                <button onclick="logout()" class="btn btn-outline-light" style="padding: .255rem .75rem; padding-top: 0.315rem;">LOGOUT</button>
            </div>
        </div>
    </div>
</nav>