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



<!-- <link rel="stylesheet" href="{{ asset('css/login.css') }}"> -->
{{-- <link rel="stylesheet" href="{{ asset('css/global.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('css/home.css') }}">

<script>
    // Listen for events emitted by the child component
    window.addEventListener('DOMContentLoaded', function() {
        
        // console.log(@json($json_file_plan));

        function storeValue(key, value) {
            if (localStorage) {
                localStorage.setItem(key, value);
            } else {
                $.cookies.set(key, value);
            }
        }

        function getStoredValue(key) {
            if (localStorage) {
                return localStorage.getItem(key);
            } else {
                return $.cookies.get(key);
            }
        }

        // console.log(getStoredValue('component'));

        if(getStoredValue('component')){
            // console.log('nav-'.concat(getStoredValue('component')));
            document.getElementById(getStoredValue('component')).style.display = "block";
        } else {
            document.getElementById('ovcpd-progress-tracker').style.display = "none";
        }

        window.addEventListener('displayComponent', function(event) {
            // Dynamically render the specified component with arguments
            const componentName = event.detail.component;
            // const componentName = sessionStorage.getItem(componentName);

            // const componentName = getStoredValue('component');
            storeValue('component', componentName);
            // console.log('test0: ' . componentName);
            // console.log(getStoredValue('component'));
            const componentArgs = event.detail.args || {}; // Default to an empty object if args not provided
            const componentContainer = document.getElementById('component-container');
            const components = ['dashboard', 'ovcpd-progress-tracker', 'ovcpd-master-plan', 'project', 'completed', 'construction', 'delayed', 'terminated', 'about'];
            // console.log(componentContainer.innerHTML);
            
            components.forEach(displayTable)
            function displayTable(component){
                if(component!=componentName){
                    document.getElementById(component).style.display = "none";
                } else {
                    document.getElementById(component).style.display = "block";
                }
            }
            // console.log(componentName);
        });
    });

    

</script>
</head>

<body class="overflow-auto" style="min-width: 720px;">
    <x-header />
    

    <div id="app" class="main-wrapper mb-0 pb-0">
        <div id="dashboard" style="display:none;">
            <x-dashboard />
        </div>

        <div id="ovcpd-progress-tracker"  style="display:none;">
            <x-ovcpd-progress-tracker :json-file="$json_file" :tracker-columns="$tracker_columns" :project-trackers="$project_trackers" />
        </div>

        <div id="ovcpd-master-plan"  style="display:none;">
            <x-ovcpd-master-plan :tracker-columns="$tracker_columns" :project-trackers="$project_trackers" :json-file="$json_file_plan" />
        </div>
    
    
        <div id="project" style="display:none;">
            <x-project 
            :json-file="$json_file" :project-headers="$project_headers"
            />
        </div>
    
        
        
        <div id="completed" style="display:none;">
        </div>

        <div id="construction" style="display:none;">
            <x-ongoing-projects />
        </div>

        <div id="delayed" style="display:none;">
        </div>

        <div id="terminated" style="display:none;">    
        </div>

        <div id="about" style="display:none;">
            <x-about />
        </div>
    </div>
    

    <x-footer/>

</body>