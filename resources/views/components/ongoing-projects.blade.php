<head>
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>

<div class="container">
    <h1>DataTable Example</h1>
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>John Doe</td>
                <td>john@example.com</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Jane Doe</td>
                <td>jane@example.com</td>
            </tr>
            <!-- Add more rows as needed -->
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        // Initialize DataTable with search and pagination enabled
        $('#example').DataTable({
            paging: true,         // Enable pagination
            searching: true,      // Enable search/filtering
            responsive: true,     // Make the table responsive
            lengthChange: true,   // Allow changing the number of records per page
            pageLength: 10,       // Set default records per page
            language: {
                paginate: {
                    first:    'First',
                    last:     'Last',
                    next:     'Next',
                    previous: 'Previous'
                },
                search: "Search:"
            }
        });
    });
</script>