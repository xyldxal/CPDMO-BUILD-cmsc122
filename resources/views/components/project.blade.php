<!DOCTYPE html>

<html>
<head>
    <title>Projects</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style scoped>

    </style>

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
    
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <!-- Search bar -->
            <div class="flex-grow-1 mr-2">
                <input type="text" class="form-control custom-search-input" placeholder="Search...">
            </div>
            
            <!-- Filter dropdown -->
            <select id="statusFilter" class="form-control filter-box">
                <option value="All">All</option>
                <option value="CAMP">CAMP</option>
                <option value="CAS">CAS</option>
                <option value="CD">CD</option>
                <option value="CN">CN</option>
                <option value="CM">CM</option>
                <option value="CP">CP</option>
                <option value="CPH">CPH</option>
            </select>
        </div>


        <div class="table-responsive table-container" id="projects-table">
            <table class="table table-striped">
                <thead>
                    <tr>
                        @foreach ($projectHeaders as $header)
                            <th scope="col">{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($jsonFile as $row)
                        <tr>
                            @foreach($row as $item)
                                @if(count($item)>1)
                                    <td>
                                        @foreach($item as $element)
                                            <div class="cell-content">{{  $element  }}</div>
                                        @endforeach
                                    </td>
                                @else
                                    <td scope="row">{{ $item[0] }}</td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
    </div>

</body>


</html>