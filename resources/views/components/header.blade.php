{{-- <link rel="stylesheet" href="{{ asset('css/nav-bar.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/login.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('css/global.css') }}">
<link rel="stylesheet" href="{{ asset('css/header.css') }}">

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
            const activeNav = document.getElementById('nav-'.concat(getStoredValue('component')));
            if (activeNav) {
                activeNav.classList.add('active');
            }
        } else {
            const defaultNav = document.getElementById('nav-ovcpd-progress-tracker');
            if (defaultNav) {
                defaultNav.classList.add('active');
            }
        }

        // Get all navigation links
        const navLinks = document.querySelectorAll('.nav-link');

        // Add click event listener to each navigation link
        navLinks.forEach(link => {
            link.addEventListener('click', (event) => {
                event.preventDefault();
                // Remove "active" class from all links
                navLinks.forEach(navLink => navLink.classList.remove('active'));
                // Add "active" class to the clicked link
                link.classList.add('active');
            });
        });

        // Keep the individual event listeners for specific functionality
        document.getElementById('nav-dashboard')?.addEventListener('click', function(event) {
            event.preventDefault();
            window.dispatchEvent(new CustomEvent('displayComponent', { detail: { component: 'dashboard' } }));
        });

        document.getElementById('nav-ovcpd-progress-tracker')?.addEventListener('click', function(event) {
            event.preventDefault();
            window.dispatchEvent(new CustomEvent('displayComponent', { detail: { component: 'ovcpd-progress-tracker' } }));
        });

        document.getElementById('nav-planning')?.addEventListener('click', function(event) {
            event.preventDefault();
            window.dispatchEvent(new CustomEvent('displayComponent', { detail: { component: 'ovcpd-master-plan' } }));
        });

        document.getElementById('nav-projects')?.addEventListener('click', function(event) {
            event.preventDefault();
            window.dispatchEvent(new CustomEvent('displayComponent', { detail: { component: 'project' } }));
        });

        document.getElementById('nav-about')?.addEventListener('click', function(event) {
            event.preventDefault();
            window.dispatchEvent(new CustomEvent('displayComponent', { detail: { component: 'about' } }));
        });

        //
        /* document.getElementById('nav-completed')?.addEventListener('click', function(event) {
            event.preventDefault();
            window.dispatchEvent(new CustomEvent('displayComponent', { detail: { component: 'completed' } }));
        });

        document.getElementById('nav-construction')?.addEventListener('click', function(event) {
            event.preventDefault();
            window.dispatchEvent(new CustomEvent('displayComponent', { detail: { component: 'construction' } }));
        });

        document.getElementById('nav-delayed')?.addEventListener('click', function(event) {
            event.preventDefault();
            window.dispatchEvent(new CustomEvent('displayComponent', { detail: { component: 'delayed' } }));
        });

        document.getElementById('nav-terminated')?.addEventListener('click', function(event) {
            event.preventDefault();
            window.dispatchEvent(new CustomEvent('displayComponent', { detail: { component: 'terminated' } }));
        }); */
    });

    function logout() {
        window.location.href = '/logout';
    }

    function storeValue(key, value) {
        if (sessionStorage) {
            sessionStorage.setItem(key, value);
        } else {
            $.cookies.set(key, value);
        }
    }

    function getStoredValue(key) {
        if (sessionStorage) {
            return sessionStorage.getItem(key);
        } else {
            return $.cookies.get(key);
        }
    }
</script>

<nav class="navbar navbar-expand-lg">
    <div class="container-xl">
        <div class="d-flex align-items-center">
            <img src="{{ asset('images/buildtemp2.png') }}" alt="BUILD" class="logo-image">
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" id="nav-dashboard" href="/dashboard">DASHBOARD</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="nav-ovcpd-progress-tracker" href="/ovcpd-progress-tracker">PROGRESS TRACKER</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="nav-planning" href="/planning">PLANNING</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="nav-projects" href="/projects">PROJECTS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="nav-about" href="/about">ABOUT</a>
                </li>
            </ul>
            <a href="/logout" class="logout-btn">LOG OUT</a>
        </div>
    </div>
</nav>