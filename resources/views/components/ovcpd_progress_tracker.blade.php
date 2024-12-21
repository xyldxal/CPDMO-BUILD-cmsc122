<!DOCTYPE html>
<html>
<head>
    <title>OVCPD Project Progress Tracker</title>
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}} 
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style scoped>


    </style>
    <link rel="stylesheet" href="{{ asset('css/ovcpd.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="mb-4 text-center">
        <h3 class="mb-2">OVCPD Project Progress Tracker</h3>
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
            <option value="Pending">Pending</option>
            <option value="In Progress">In Progress</option>
            <option value="Finished">Completed</option>
        </select>
    </div>
    
    
    

    <div class="row">
        @foreach ($projectTrackers as $tracker)
            <div class="col-md-4 mb-4">
                <div class="card" data-toggle="modal" data-target="#detailsModal{{ $tracker->id }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $tracker->project_title ? $tracker->project_title : 'N/A' }}</h5>
                        <p class="card-text"><strong>Tracking number: </strong> {{ $tracker->tracking_number }}</p>
                        <p class="card-text"><strong>Status: </strong>{{ $tracker->proj_status }}</p>
                        <div class="card-text">
                            <div class="progress">
                                <div class="progress-bar 
                                    @if($tracker->percentage_complete < 40)
                                        bg-danger
                                    @elseif($tracker->percentage_complete < 70)
                                        bg-warning
                                    @else
                                        bg-success
                                    @endif
                                    " role="progressbar" style="width: {{ $tracker->percentage_complete }}%;" aria-valuenow="{{ $tracker->percentage_complete }}" aria-valuemin="0" aria-valuemax="100">
                                    {{ $tracker->percentage_complete }}%
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="detailsModal{{ $tracker->id }}" tabindex="-1" aria-labelledby="detailsModalLabel{{ $tracker->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailsModalLabel{{ $tracker->id }}">Project Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><strong>X</strong></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <ul class="list-group mb-3">
                                <li class="list-group-item"><strong>Tracking Number:</strong> {{ $tracker->tracking_number }}</li>
                                <li class="list-group-item"><strong>Requirement Description:</strong> {{ $tracker->requirement_desc }}</li>
                                <li class="list-group-item"><strong>Percentage Complete:</strong> {{ $tracker->percentage_complete }}</li>
                                <li class="list-group-item"><strong>Project Status:</strong> {{ $tracker->proj_status }}</li>
                                <li class="list-group-item"><strong>Complete Submission:</strong> {{ $tracker->complete_submission }}</li>
                                <li class="list-group-item"><strong>Detailed Drawings:</strong> {{ $tracker->detailed_drawings }}</li>
                                <li class="list-group-item"><strong>Scope of Work:</strong> {{ $tracker->scope_of_work }}</li>
                                <li class="list-group-item"><strong>Estimate:</strong> {{ $tracker->estimate }}</li>
                                <li class="list-group-item"><strong>Pert CPM:</strong> {{ $tracker->pert_cpm }}</li>
                                <li class="list-group-item"><strong>Payment Status:</strong> {{ $tracker->payment_status }}</li>
                                <li class="list-group-item"><strong>PAR ICS Attachment:</strong> {{ $tracker->par_ics_attachment }}</li>
                                <li class="list-group-item"><strong>Payment Status 2:</strong> {{ $tracker->payment_status_2 }}</li>
                                <li class="list-group-item"><strong>PAR ICS Attachment 2:</strong> {{ $tracker->par_ics_attachment_2 }}</li>

                            </ul>
                            <h5>Project Timeline</h5>
                            <ul class="timeline-horizontal">
                                @foreach([
                                    'proj_folder_submission' => 'Project Folder Submission',
                                    'ovcpd_endorsement' => 'OVCPD Endorsement',
                                    'budget_clearance' => 'Budget Clearance',
                                    'ovcaf_approval' => 'OVCAF Approval',
                                    'opening' => 'Opening',
                                    'bid_eval' => 'Bid Evaluation',
                                    'post_qualification' => 'Post Qualification',
                                    'bidding' => 'Bidding',
                                    'contract_completion' => 'Contract Completion',
                                    'received_proj_folder' => 'Received Project Folder',
                                    'preconstruction_meet' => 'Preconstruction Meet',
                                    'date_accomplished' => 'Date Accomplished',
                                    'contract_end' => 'Contract End',
                                    'completion_cert' => 'Completion Certificate',
                                    'final_bill_submission' => 'Final Bill Submission',
                                    // 'par_ics_attachment_2' => 'PAR ICS Attachment 2',
                                    'date_accomplished_2' => 'Date Accomplished 2',
                                    // 'payment_status_2' => 'Payment Status 2',
                                    'final_bill_payment_received' => 'Final Bill Payment Received',
                                    'retention_bill_submission' => 'Retention Bill Submission',
                                    'retention_bill_payment_received' => 'Retention Bill Payment Received',
                                ] as $key => $label)
                                    @if($tracker->$key)
                                        <li class="timeline-item">
                                            <div class="timeline-point"></div>
                                           
                                            <div class="timeline-content">
                                                <p class="timeline-date">{{ $label }}</p>
                                                <p>{{ $tracker->$key }}</p>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
$(document).ready(function() {
    // Ensure backdrop is added
    $('.modal').modal({
        backdrop: 'static',
        keyboard: false
    });
    
    // Clean up modal backdrop on close
    $('.modal').on('hidden.bs.modal', function () {
        if($('.modal.show').length) {
            $('body').addClass('modal-open');
        }
    });
});
</script>

</body>
</html>
