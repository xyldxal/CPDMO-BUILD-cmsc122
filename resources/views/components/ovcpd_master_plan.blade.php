<!DOCTYPE html>

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/masterplan.css') }}");

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<div>
    <header class="cd__intro w-100 d-flex align-items-center justify-content-between">
        <h1 class="text-nowrap ml-2">Master Development Plan</h1>
        <div class="" >
            <button class="btn btn-success btn-add-plan mr-1" id="add-button">Add Entry</button>
            <button type="button" class="btn btn-primary btn-bulk btn-bulk-plan">
                <i class="fas fa-file-import"></i>
            </button>
        </div>
    </header>
    <div class="main-tabs">
        <div class="nav nav-tabs" id="main-nav-tab" role="tablist">
            <button class="nav-link active" id="nav-details-main-tab" data-bs-toggle="tab" data-bs-target="#nav-details-main" type="button" role="tab" aria-controls="nav-details-main" aria-selected="true">Project Details</button>
            <button class="nav-link" id="nav-plan-design-main-tab" data-bs-toggle="tab" data-bs-target="#nav-plan-design-main" type="button" role="tab">Planning and Design</button>
            <button class="nav-link" id="nav-bac-main-tab" data-bs-toggle="tab" data-bs-target="#nav-bac-main" type="button" role="tab">BAC</button>
            <button class="nav-link" id="nav-procurement-main-tab" data-bs-toggle="tab" data-bs-target="#nav-procurement-main" type="button" role="tab">Procurement</button>
            <button class="nav-link" id="nav-implementation-main-tab" data-bs-toggle="tab" data-bs-target="#nav-implementation-main" type="button" role="tab">Implementation</button>
            <button class="nav-link" id="nav-spmo-main-tab" data-bs-toggle="tab" data-bs-target="#nav-spmo-main" type="button" role="tab">SPMO</button>
            <button class="nav-link" id="nav-acceptance-main-tab" data-bs-toggle="tab" data-bs-target="#nav-acceptance-main" type="button" role="tab">Acceptance</button>
            <button class="nav-link" id="nav-release-main-tab" data-bs-toggle="tab" data-bs-target="#nav-release-main" type="button" role="tab">Release of Retention</button>
        </div>
    </div>
    <div class="w-100 pt-0 pr-3">
        <table id="7324bc4d609c6acab008c8b90fd03a45bfad3218" class="display table table-striped text-nowrap " style="width:100%">
            <thead>
            </thead>
            <tbody id="form-body-ajax">
            </tbody>
        </table>
    </div>

    <!-- EDIT Modal HTML -->
    <div class="container mt-4 modal-font">
        <div id="plan-modal-edit" class="modal">
            <div class="modal-title modal-main">
                <div class="grid">
                    <div class="g-col-4">
                        <span class="close close-modal ">&times;</span>
                    </div>
                    <div id="modal-title" class="inner-title h2 g-col-6 g-col-md-4 ms-auto">Title</div>
                    
                </div>
            </div>
            <div class="modal-content">
                <nav>
                <div class="nav nav-tabs" id="nav-tab-plan" role="tablist">
                    <a class="nav-link active" id="nav-details-tab" data-bs-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-details" aria-selected="true">Project Details</a>
                    <a class="nav-link" id="nav-plan-design-tab" data-bs-toggle="tab" href="#nav-plan-design" role="tab" aria-controls="nav-plan-design" aria-selected="false">Planning and Design</a>
                    <a class="nav-link" id="nav-bac-tab" data-bs-toggle="tab" href="#nav-bac" role="tab" aria-controls="nav-bac" aria-selected="false">BAC</a>
                    <a class="nav-link" id="nav-procurement-tab" data-bs-toggle="tab" href="#nav-procurement" role="tab" aria-controls="nav-procurement" aria-selected="false">Procurement</a>
                    <a class="nav-link" id="nav-implementation-tab" data-bs-toggle="tab" href="#nav-implementation" role="tab" aria-controls="nav-implementation" aria-selected="false">Implementation</a>
                    <a class="nav-link" id="nav-spmo-tab" data-bs-toggle="tab" href="#nav-spmo" role="tab" aria-controls="nav-spmo" aria-selected="false">SPMO</a>
                    <a class="nav-link" id="nav-acceptance-tab" data-bs-toggle="tab" href="#nav-acceptance" role="tab" aria-controls="nav-acceptance" aria-selected="false">Acceptance</a>
                    <a class="nav-link" id="nav-release-tab" data-bs-toggle="tab" href="#nav-release" role="tab" aria-controls="nav-release" aria-selected="false">Release of Retention</a>
                </div>

                </nav>
                <form id="plan-modal-form-edit" method="POST">
                    @csrf
                    <div class="tab-content" id="nav-tabContent">
                            
                            <!-- PROJECT DETAILS -->
                            <div class="tab-pane fade show active" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
                                    <div class="form-group">
                                        <label for="tracking_number">Tracking Number</label>
                                        <input type="text" id="tracking_number-plan" name="tracking_number" class="form-control" value="" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="project_title">Project Title</label>
                                        <input type="text" id="project_title-plan" name="project_title" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="project_description">Project Description</label>
                                        <input type="text" id="project_description-plan" name="project_description" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="end_user_id">End User</label>
                                        <select id="end_user_id" name="end_user_id" class="end_user_id form-control">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="fund_source_id">Fund Source</label>
                                        <select id="fund_source_id" name="fund_source_id" class="fund_source_id form-control">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="budget">Budget</label>
                                        <input type="number" min-value=0 step=0.01 id="budget" name="budget" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="bid_amount">Bid Amount</label>
                                        <input type="bid_amount" min-value=0 step=0.01 id="bid_amount" name="bid_amount" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="contractor">Contractor</label>
                                        <input type="text" id="contractor" name="contractor" class="form-control" value="">
                                    </div>
                            </div>

                            <!-- PLANNING AND DESIGN PHASE -->
                            <div class="tab-pane fade" id="nav-plan-design" role="tabpanel" aria-labelledby="nav-plan-design-tab">
                                <div class="form-group">
                                    <label for="requirement_desc">Requirement Description</label>
                                    <input type="textarea" id="requirement_desc" name="requirement_desc" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <label for="complete_submission">Complete Submission</label>
                                    <input type="textarea" id="complete_submission" name="complete_submission" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <label for="detailed_drawings">Detailed Drawings</label>
                                    <input type="checkbox" id="detailed_drawings" name="detailed_drawings" class="form-checkbox" value="true">
                                </div>
                                <div class="form-group">
                                    <label for="scope_of_work">Scope of Work</label>
                                    <input type="checkbox" id="scope_of_work" name="scope_of_work" class="form-checkbox" value="true">
                                </div>
                                <div class="form-group">
                                    <label for="estimate">Estimate</label>
                                    <input type="checkbox" id="estimate" name="estimate" class="form-checkbox" value="true">
                                </div>
                                <div class="form-group">
                                    <label for="pert_cpm">Pert CPM</label>
                                    <input type="checkbox" id="pert_cpm" name="pert_cpm" class="form-checkbox" value="true">
                                </div>
                                <div class="form-group">
                                    <label for="proj_folder_submission">Project Folder Submission</label>
                                    <input type="date" id="proj_folder_submission" name="proj_folder_submission" class="form-control" value="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="ovcpd_endorsement">OVCPD Endorsement</label>
                                    <input type="date" id="ovcpd_endorsement" name="ovcpd_endorsement" class="form-control" value="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="budget_clearance">Budget Clearance</label>
                                    <input type="date" id="budget_clearance" name="budget_clearance" class="form-control" value="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="ovcaf_approval">OVCAF Approval</label>
                                    <input type="date" id="ovcaf_approval" name="ovcaf_approval" class="form-control" value="" placeholder="">
                                </div>
                            </div>

                            <!-- BAC BIDDING -->
                            <div class="tab-pane fade" id="nav-bac" role="tabpanel" aria-labelledby="nav-bac-tab">
                                <div class="form-group">
                                    <label for="opening">Opening</label>
                                    <input type="date" id="opening" name="opening" class="form-control" value="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="bid_eval">Bid Evaluation</label>
                                    <input type="date" id="bid_eval" name="bid_eval" class="form-control" value="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="post_qualification">Post Qualification</label>
                                    <input type="date" id="post_qualification" name="post_qualification" class="form-control" value="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="bidding">Bidding</label>
                                    <input type="date" id="bidding" name="bidding" class="form-control" value="" placeholder="">
                                </div>
                            </div>

                            <!-- PROCUREMENT -->
                            <div class="tab-pane fade" id="nav-procurement" role="tabpanel" aria-labelledby="nav-procurement-tab">
                                <div class="form-group">
                                    <label for="issuance_of_noa">Issuance of NOA</label>
                                    <input type="date" id="issuance_of_noa" name="issuance_of_noa" class="form-control" value="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="contract_completion">Contract Completion</label>
                                    <input type="date" id="contract_completion" name="contract_completion" class="form-control" value="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="notice_to_proceed">Notice to Proceed (NOA)</label>
                                    <input type="date" id="notice_to_proceed-plan" name="notice_to_proceed" class="form-control" value="" placeholder="">
                                </div>
                            </div>

                            <!-- IMPLEMENTATION -->
                            <div class="tab-pane fade" id="nav-implementation" role="tabpanel" aria-labelledby="nav-implementation-tab">
                                <div class="form-group">
                                    <label for="received_proj_folder">Received Project Folder</label>
                                    <input type="date" id="received_proj_folder" name="received_proj_folder" class="form-control" value="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="preconstruction_meet">Preconstruction Meeting</label>
                                    <input type="date" id="preconstruction_meet" name="preconstruction_meet" class="form-control" value="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="percentage_complete">Percentage Complete</label>
                                    <input type="number" min-value=0 max-value=100 step=0.01 id="percentage_complete" name="percentage_complete" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <label for="proj_status">Project Status</label>
                                    <input type="textarea" id="proj_status" name="proj_status" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <label for="payment_status">Payment Status</label>
                                    <input type="textarea" id="payment_status" name="payment_status" class="form-control" value="">
                                </div>
                            </div>

                            <!-- SPMO -->
                            <div class="tab-pane fade" id="nav-spmo" role="tabpanel" aria-labelledby="nav-spmo-tab">
                                <div class="form-group">
                                    <label for="par_ics_attachment">PAR/ICS Attachment</label>
                                    <input type="checkbox" id="par_ics_attachment" name="par_ics_attachment" class="form-checkbox" value="true">
                                </div>
                                <div class="form-group">
                                    <label for="date_accomplished">Date Accomplished</label>
                                    <input type="date" id="date_accomplished" name="date_accomplished" class="form-control" value="" placeholder="">
                                </div>
                            </div>

                            <!-- ACCEPTANCE -->
                            <div class="tab-pane fade" id="nav-acceptance" role="tabpanel" aria-labelledby="nav-acceptance-tab">
                                <div class="form-group">
                                    <label for="contract_end">Contract End</label>
                                    <input type="date" id="contract_end" name="contract_end" class="form-control" value="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="completion_cert">Completion Certificate</label>
                                    <input type="date" id="completion_cert" name="completion_cert" class="form-control" value="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="final_bill_submission">Final Bill Submission</label>
                                    <input type="date" id="final_bill_submission" name="final_bill_submission" class="form-control" value="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="par_ics_attachment2">PAR/ICS Attachment</label>
                                    <input type="checkbox" id="par_ics_attachment2" name="par_ics_attachment2" class="form-checkbox" value="true">
                                </div>
                                <div class="form-group">
                                    <label for="date_accomplished_2">Date Accomplished</label>
                                    <input type="date" id="date_accomplished_2" name="date_accomplished_2" class="form-control" value="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="payment_status_2">Payment Status</label>
                                    <input type="textarea" id="payment_status_2" name="payment_status_2" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <label for="final_bill_payment_received">Final Bill Payment</label>
                                    <input type="date" id="final_bill_payment_received" name="final_bill_payment_received" class="form-control" value="" placeholder="">
                                </div>
                            </div>

                            <!-- RELEASE OF RETENTION -->
                            <div class="tab-pane fade" id="nav-release" role="tabpanel" aria-labelledby="nav-release-tab">
                                <div class="form-group">
                                    <label for="retention_bill_submission">Retention Bill Submission</label>
                                    <input type="date" id="retention_bill_submission" name="retention_bill_submission" class="form-control" value="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="retention_bill_payment_received">Retention Bill Payment</label>
                                    <input type="date" id="retention_bill_payment_received" name="retention_bill_payment_received" class="form-control" value="" placeholder="">
                                </div>
                            </div>
                    </div>
                    <hr>
                    <div style="text-align: right;">
                        <button id="plan-edit-form-save-btn" type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ADD Modal HTML -->
    <div class="container mt-4 modal-font">
        <div id="plan-modal-add" class="modal">
            <div class="modal-title modal-main">
                <div class="grid">
                    <div class="g-col-4">
                        <span class="close close-modal ">&times;</span>
                    </div>
                    <div id="modal-title" class="inner-title h2 g-col-6 g-col-md-4 ms-auto">Title</div>
                    
                </div>
            </div>
            <div class="modal-content">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab-1" role="tablist">
                        <button class="nav-link active" id="nav-details-tab-1" data-bs-toggle="tab" data-bs-target="#nav-details-1" type="button" role="tab" aria-controls="nav-details-1" aria-selected="true">Project Details</button>
                        <button class="nav-link" id="nav-plan-design-tab-1" data-bs-toggle="tab" data-bs-target="#nav-plan-design-1" type="button" role="tab" aria-controls="nav-plan-design-1" aria-selected="false">Planning and Design</button>
                        <button class="nav-link" id="nav-bac-tab-1" data-bs-toggle="tab" data-bs-target="#nav-bac-1" type="button" role="tab" aria-controls="nav-bac-1" aria-selected="false">BAC</button>
                        <button class="nav-link" id="nav-procurement-tab-1" data-bs-toggle="tab" data-bs-target="#nav-procurement-1" type="button" role="tab" aria-controls="nav-procurement-1" aria-selected="false">Procurement</button>
                        <button class="nav-link" id="nav-implementation-tab-1" data-bs-toggle="tab" data-bs-target="#nav-implementation-1" type="button" role="tab" aria-controls="nav-implementation-1" aria-selected="false">Implementation</button>
                        <button class="nav-link" id="nav-spmo-tab-1" data-bs-toggle="tab" data-bs-target="#nav-spmo-1" type="button" role="tab" aria-controls="nav-spmo-1" aria-selected="false">SPMO</button>
                        <button class="nav-link" id="nav-acceptance-tab-1" data-bs-toggle="tab" data-bs-target="#nav-acceptance-1" type="button" role="tab" aria-controls="nav-acceptance-1" aria-selected="false">Acceptance</button>
                        <button class="nav-link" id="nav-release-tab-1" data-bs-toggle="tab" data-bs-target="#nav-release-1" type="button" role="tab" aria-controls="nav-release-1" aria-selected="false">Release of Retention</button>
                    </div>
                </nav>
                <form id="plan-modal-form-add" method="POST">
                    @csrf
                    <div class="tab-content" id="nav-tabContent-1">
                            
                                <!-- PROJECT DETAILS -->
                                <div class="tab-pane fade show active" id="nav-details-1" role="tabpanel" aria-labelledby="nav-details-tab-1">
                                        <div class="form-group">
                                            <label for="tracking_number">Tracking Number</label>
                                            <input type="text" id="tracking_number-plan-1" name="tracking_number" class="form-control" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="project_title">Project Title</label>
                                            <input type="text" id="project_title-plan-1" name="project_title" class="form-control" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="project_description">Project Description</label>
                                            <input type="text" id="project_description-plan-1" name="project_description" class="form-control" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="end_user_id">End User</label>
                                            <select id="end_user_id-1" name="end_user_id" class="end_user_id form-control">
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="fund_source_id">Fund Source</label>
                                            <select id="fund_source_id-1" name="fund_source_id" class="fund_source_id form-control">
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="budget">Budget</label>
                                            <input type="number" min-value=0 step=0.01 id="budget-1" name="budget" class="form-control" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="bid_amount">Bid Amount</label>
                                            <input type="bid_amount" min-value=0 step=0.01 id="bid_amount-1" name="bid_amount" class="form-control" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="contractor">Contractor</label>
                                            <input type="text" id="contractor-1" name="contractor" class="form-control" value="">
                                        </div>
                                </div>

                                <!-- PLANNING AND DESIGN PHASE -->
                                <div class="tab-pane fade" id="nav-plan-design-1" role="tabpanel" aria-labelledby="nav-plan-design-tab-1">
                                    <div class="form-group">
                                        <label for="requirement_desc">Requirement Description</label>
                                        <input type="textarea" id="requirement_desc-1" name="requirement_desc" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="complete_submission">Complete Submission</label>
                                        <input type="textarea" id="complete_submission-1" name="complete_submission" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="detailed_drawings">Detailed Drawings</label>
                                        <input type="checkbox" id="detailed_drawings-1" name="detailed_drawings" class="form-checkbox" value="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="scope_of_work">Scope of Work</label>
                                        <input type="checkbox" id="scope_of_work-1" name="scope_of_work" class="form-checkbox" value="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="estimate">Estimate</label>
                                        <input type="checkbox" id="estimate-1" name="estimate" class="form-checkbox" value="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="pert_cpm">Pert CPM</label>
                                        <input type="checkbox" id="pert_cpm-1" name="pert_cpm" class="form-checkbox" value="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="proj_folder_submission">Project Folder Submission</label>
                                        <input type="date" id="proj_folder_submission-1" name="proj_folder_submission" class="form-control" value="" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="ovcpd_endorsement">OVCPD Endorsement</label>
                                        <input type="date" id="ovcpd_endorsement-1" name="ovcpd_endorsement" class="form-control" value="" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="budget_clearance">Budget Clearance</label>
                                        <input type="date" id="budget_clearance-1" name="budget_clearance" class="form-control" value="" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="ovcaf_approval">OVCAF Approval</label>
                                        <input type="date" id="ovcaf_approval-1" name="ovcaf_approval" class="form-control" value="" placeholder="">
                                    </div>
                                </div>

                                <!-- BAC BIDDING -->
                                <div class="tab-pane fade" id="nav-bac-1" role="tabpanel" aria-labelledby="nav-bac-tab-1">
                                    <div class="form-group">
                                        <label for="opening">Opening</label>
                                        <input type="date" id="opening-1" name="opening" class="form-control" value="" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="bid_eval">Bid Evaluation</label>
                                        <input type="date" id="bid_eval-1" name="bid_eval" class="form-control" value="" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="post_qualification">Post Qualification</label>
                                        <input type="date" id="post_qualification-1" name="post_qualification" class="form-control" value="" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="bidding">Bidding</label>
                                        <input type="date" id="bidding-1" name="bidding" class="form-control" value="" placeholder="">
                                    </div>
                                </div>

                                <!-- PROCUREMENT -->
                                <div class="tab-pane fade" id="nav-procurement-1" role="tabpanel" aria-labelledby="nav-procurement-tab-1">
                                    <div class="form-group">
                                        <label for="issuance_of_noa">Issuance of NOA</label>
                                        <input type="date" id="issuance_of_noa-1" name="issuance_of_noa" class="form-control" value="" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="contract_completion">Contract Completion</label>
                                        <input type="date" id="contract_completion-1" name="contract_completion" class="form-control" value="" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="notice_to_proceed">Notice to Proceed (NOA)</label>
                                        <input type="date" id="notice_to_proceed-plan-1" name="notice_to_proceed" class="form-control" value="" placeholder="">
                                    </div>
                                </div>

                                <!-- IMPLEMENTATION -->
                                <div class="tab-pane fade" id="nav-implementation-1" role="tabpanel" aria-labelledby="nav-implementation-tab-1">
                                    <div class="form-group">
                                        <label for="received_proj_folder">Received Project Folder</label>
                                        <input type="date" id="received_proj_folder-1" name="received_proj_folder" class="form-control" value="" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="preconstruction_meet">Preconstruction Meeting</label>
                                        <input type="date" id="preconstruction_meet-1" name="preconstruction_meet" class="form-control" value="" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="percentage_complete">Percentage Complete</label>
                                        <input type="number" min-value=0 max-value=100 step=0.01 id="percentage_complete-1" name="percentage_complete" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="proj_status">Project Status</label>
                                        <input type="textarea" id="proj_status-1" name="proj_status" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="payment_status">Payment Status</label>
                                        <input type="textarea" id="payment_status-1" name="payment_status" class="form-control" value="">
                                    </div>
                                </div>

                                <!-- SPMO -->
                                <div class="tab-pane fade" id="nav-spmo-1" role="tabpanel" aria-labelledby="nav-spmo-tab-1">
                                    <div class="form-group">
                                        <label for="par_ics_attachment">PAR/ICS Attachment</label>
                                        <input type="checkbox" id="par_ics_attachment-1" name="par_ics_attachment" class="form-checkbox" value="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="date_accomplished">Date Accomplished</label>
                                        <input type="date" id="date_accomplished-1" name="date_accomplished" class="form-control" value="" placeholder="">
                                    </div>
                                </div>

                                <!-- ACCEPTANCE -->
                                <div class="tab-pane fade" id="nav-acceptance-1" role="tabpanel" aria-labelledby="nav-acceptance-tab-1">
                                    <div class="form-group">
                                        <label for="contract_end">Contract End</label>
                                        <input type="date" id="contract_end-1" name="contract_end" class="form-control" value="" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="completion_cert">Completion Certificate</label>
                                        <input type="date" id="completion_cert-1" name="completion_cert" class="form-control" value="" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="final_bill_submission">Final Bill Submission</label>
                                        <input type="date" id="final_bill_submission-1" name="final_bill_submission" class="form-control" value="" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="par_ics_attachment2">PAR/ICS Attachment</label>
                                        <input type="checkbox" id="par_ics_attachment2-1" name="par_ics_attachment2" class="form-checkbox" value="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="date_accomplished_2">Date Accomplished</label>
                                        <input type="date" id="date_accomplished_2-1" name="date_accomplished_2" class="form-control" value="" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="payment_status_2">Payment Status</label>
                                        <input type="textarea" id="payment_status_2-1" name="payment_status_2" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="final_bill_payment_received">Final Bill Payment</label>
                                        <input type="date" id="final_bill_payment_received-1" name="final_bill_payment_received" class="form-control" value="" placeholder="">
                                    </div>
                                </div>

                                <!-- RELEASE OF RETENTION -->
                                <div class="tab-pane fade" id="nav-release-1" role="tabpanel" aria-labelledby="nav-release-tab-1">
                                    <div class="form-group">
                                        <label for="retention_bill_submission">Retention Bill Submission</label>
                                        <input type="date" id="retention_bill_submission-1" name="retention_bill_submission" class="form-control" value="" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="retention_bill_payment_received">Retention Bill Payment</label>
                                        <input type="date" id="retention_bill_payment_received-1" name="retention_bill_payment_received" class="form-control" value="" placeholder="">
                                    </div>
                                </div>
                    </div>
                    <button id="plan-add-form-save-btn" type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal HTML -->
    <div id="plan-modal-del" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Confirmation</h5>
                <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this project plan?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal" data-bs-dismiss="modal">Cancel</button>
                <form id="plan-modal-delete" method="POST">
                    @csrf
                    @method('DELETE')
                    <button id="form-del-btn"type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
            </div>
        </div>
    </div>

    <!-- Bulk Upload Modal HTML -->
    <div class="container modal-font" >
        <div id="modal-bulk-plan" class="modal">
            <div class="modal-title modal-main" style="margin-top: 14vh; max-width: 50%;">
                <div class="grid">
                    <div class="g-col-4">
                        <span class="close close-modal ">&times;</span>
                    </div>
                    <div id="bulk-modal-plan-title" class="h2 g-col-6 g-col-md-4 ms-auto">Bulk Upload</div>
                    
                </div>
            </div>
            <div class="modal-content" style="max-width: 50%;">
                <div class="modal-body">
                    <h6>Please use the included excel file as template for bulk uploads.</h6>
                    <form id="bulk-upload-form-plan" method="POST" enctype="multipart/form-data" action='/form/upload/Plan'>
                        @csrf
                        <div class="mb-3">
                            <input type="file" id="uploaded_file" name="uploaded_file" class="form-control" accept=".xlsx" required>
                            <p><i>For choices not included in the dropdowns, please add the new choices to the Choices sheet.</i></p>
                        </div>
                    </form>
                    <div id="bulk-upload-hook-plan"></div>
                </div>
                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-secondary close-modal" data-bs-dismiss="modal">Cancel</button>
                    <button id="bulk-upload-btn-plan" type="submit" form="bulk-upload-form-plan" class="btn btn-success">Upload</button>
                </div>
            </div>
        </div>
    </div>

    <div id="plan-flash-message" class="flash-message"></div>

</div>

<script>
    $(document).ready(function() {
        var table = $('#7324bc4d609c6acab008c8b90fd03a45bfad3218').DataTable({
            paging: true,
            searching: true,
            responsive: true,
            lengthChange: true,
            pageLength: 10,
            columnDefs: [
                {
                    defaultContent: "-",
                    targets: "_all",
                    orderable: false,
                    className: 'text-nowrap'
                }
            ],
            language: {
                paginate: {
                    first: 'First',
                    last: 'Last',
                    next: 'Next',
                    previous: 'Previous'
                },
                search: "Search:"
            },
            ajax: {
                url: '/MasterPlan/c/JSON',
                dataSrc: '',
            },
            columns: [
                { data: 'tracking_number', title: 'Tracking Number', tab: 'details' },
                { data: 'project_title', title: 'Project Title', tab: 'details' },
                { data: 'project_description', title: 'Project Description', tab: 'details' },
                { data: 'end_user_id', title: 'End User', tab: 'details' },
                { data: 'fund_source_id', title: 'Fund Source', tab: 'details' },
                { data: 'budget', title: 'Budget', tab: 'details' },
                { data: 'bid_amount', title: 'Bid Amount', tab: 'details' },
                { data: 'contractor', title: 'Contractor', tab: 'details' },
                
                // Planning and Design columns
                { data: 'requirement_desc', title: 'Requirement Description', tab: 'plan-design' },
                { data: 'complete_submission', title: 'Complete Submission', tab: 'plan-design' },
                { data: 'detailed_drawings', title: 'Detailed Drawings', tab: 'plan-design' },
                { data: 'scope_of_work', title: 'Scope of Work', tab: 'plan-design' },
                { data: 'estimate', title: 'Estimate', tab: 'plan-design' },
                { data: 'pert_cpm', title: 'PERT CPM', tab: 'plan-design' },
                
                // BAC columns
                { data: 'opening', title: 'Opening', tab: 'bac', render: (data) => data ? `${String(new Date(data).getDate()).padStart(2, '0')} ${new Date(data).toLocaleString('en-US', { month: 'short' }).toUpperCase()} ${new Date(data).getFullYear()}` : '' },
                { data: 'pre_bid', title: 'Pre-bid', tab: 'bac' },
                { data: 'detailed_bid_eval', title: 'Detailed Bid Evaluation', tab: 'bac' },
                
                // Procurement columns
                { data: 'purchase_request', title: 'Purchase Request', tab: 'procurement' },
                { data: 'ntp', title: 'NTP', tab: 'procurement' },
                
                // Implementation columns
                { data: 'delivery', title: 'Delivery', tab: 'implementation' },
                { data: 'inspection', title: 'Inspection', tab: 'implementation' },
                
                // SPMO columns
                { data: 'par_ics_attachment', title: 'PAR/ICS Attachment', tab: 'spmo' },
                { data: 'date_accomplished', title: 'Date Accomplished', tab: 'spmo', render: (data) => data ? `${String(new Date(data).getDate()).padStart(2, '0')} ${new Date(data).toLocaleString('en-US', { month: 'short' }).toUpperCase()} ${new Date(data).getFullYear()}` : '' },
                
                // Acceptance columns
                { data: 'contract_end', title: 'Contract End Date', tab: 'acceptance', render: (data) => data ? `${String(new Date(data).getDate()).padStart(2, '0')} ${new Date(data).toLocaleString('en-US', { month: 'short' }).toUpperCase()} ${new Date(data).getFullYear()}` : '' },
                { data: 'completion_cert', title: 'Completion Certificate', tab: 'acceptance', render: (data) => data ? `${String(new Date(data).getDate()).padStart(2, '0')} ${new Date(data).toLocaleString('en-US', { month: 'short' }).toUpperCase()} ${new Date(data).getFullYear()}` : '' },
                
                // Release of Retention columns
                { data: 'final_bill_submission', title: 'Final Bill Submission', tab: 'release', render: (data) => data ? `${String(new Date(data).getDate()).padStart(2, '0')} ${new Date(data).toLocaleString('en-US', { month: 'short' }).toUpperCase()} ${new Date(data).getFullYear()}` : '' },
                { data: 'par_ics_attachment_2', title: 'PAR/ICS Attachment', tab: 'release' },
                {
                    title: "Actions",
                    orderable: false,
                    className: "table-fixed",
                    render: function(data, type, row) {
                        const id = row.tracking_number;
                        return `
                            <a class="edit"><i data-id="${id}" class="btn-edit-plan material-icons">&#xE254;</i></a>
                            <a class="delete"><i data-id="${id}" class="btn-delete-plan material-icons">&#xE872;</i></a>
                        `;
                    }
                }
            ],
            initComplete: function() {
                showTabColumns('details'); // Show Project Details columns by default
            }
        });

        // Function to show/hide columns based on active tab
        function showTabColumns(tabName) {
            table.columns().every(function() {
                var column = this;
                var columnTab = table.settings().init().columns[column.index()].tab;
                
                if (!columnTab || columnTab === tabName) {
                    column.visible(true);
                } else {
                    column.visible(false);
                }
            });
        }

        // Handle tab clicks
        $('.main-tabs .nav-link').on('click', function(e) {
            e.preventDefault();
            var tabId = $(this).attr('id');
            var tabName = tabId.replace('nav-', '').replace('-main-tab', '');
            
            $('.main-tabs .nav-link').removeClass('active');
            $(this).addClass('active');
            
            showTabColumns(tabName);
            table.columns.adjust().draw();
        });

        // Add Entry button handler
        $('#add-button').on('click', function() {
            showPlanModal();
        });

        // Bulk upload button handler
        $('.btn-bulk-plan').on('click', function() {
            $('#bulk-upload-modal-plan').modal('show');
        });

        // Edit button handler
        $(document).on('click', '.btn-edit-plan', function() {
            const id = $(this).data('id');
            showPlanModal(id);
        });

        // Delete button handler
        $(document).on('click', '.btn-delete-plan', function() {
            const id = $(this).data('id');
            deletePlanModal(id);
        });

        function showPlanModal(entryId = null) {
            var counter = entryId === null ? 1 : 0;
            var link = '/form/show/ProjectTracker' + (entryId ? '/' + entryId : '');
            var action = entryId === null ? 'Add New Project Master Plan' : 'Edit Project Master Plan';
            $('.inner-title').text(entryId === null ? 'Add New Project Master Plan' : 'Edit Project Master Plan');
            $.ajax({
                url: link,
                method: 'GET',
                success: function(response) {
                    // console.log(response.FundSource);

                    const fundSourceSelect = document.getElementsByClassName('fund_source_id')[counter];
                    const endUserSelect = document.getElementsByClassName('end_user_id')[counter];

                    if (fundSourceSelect && endUserSelect) {
                        clearOptions();
                        // Populate select elements
                        populateSelect(fundSourceSelect, response.FundSource, '-- Select Fund Source --');
                        populateSelect(endUserSelect, response.EndUser, '-- Select End User --');
                    } else {
                        console.error("One or more select elements not found");
                    }

                    function clearOptions() {
                        fundSourceSelect.innerHTML = '';
                        endUserSelect.innerHTML = '';
                    }

                    function populateSelect(selectElement, valuesArray, defaultText) {
                        const defaultOption = document.createElement('option');
                        defaultOption.value = '';
                        defaultOption.text = defaultText;
                        selectElement.appendChild(defaultOption);

                        valuesArray.forEach(function(unit) {
                            const keys = Object.keys(unit);
                            const valueKey = keys[0];
                            const textKey = keys[1];

                            const option = document.createElement('option');
                            option.value = unit[valueKey];
                            option.text = unit[textKey].charAt(0).toUpperCase() + unit[textKey].slice(1); 
                            selectElement.appendChild(option);
                        });
                    }

                    console.log(response.ProjectTracker);

                    if(entryId !== null){
                        // SET DEFAULT VALUES
                        $('#tracking_number-plan').val(response.ProjectTracker.tracking_number);
                        $('#project_title-plan').val(response.ProjectTracker.project_title);
                        $('#project_description-plan').val(response.ProjectTracker.project_description);
                        $('#end_user_id').val(response.ProjectTracker.end_user_id);
                        $('#fund_source_id').val(response.ProjectTracker.fund_source_id);
                        $('#budget').val(response.ProjectTracker.budget);
                        $('#bid_amount').val(response.ProjectTracker.bid_amount);
                        $('#contractor').val(response.ProjectTracker.contractor);

                        $('#requirement_desc').val(response.ProjectTracker.requirement_desc);
                        $('#complete_submission').val(response.ProjectTracker.complete_submission);
                        $('#detailed_drawings').prop('checked', response.ProjectTracker.detailed_drawings);
                        $('#scope_of_work').prop('checked', response.ProjectTracker.scope_of_work);
                        $('#estimate').prop('checked', response.ProjectTracker.estimate);
                        $('#pert_cpm').prop('checked', response.ProjectTracker.pert_cpm);
                        $('#proj_folder_submission').val(response.ProjectTracker.proj_folder_submission ? new Date(response.ProjectTracker.proj_folder_submission).toISOString().split('T')[0] : new Date().toLocaleDateString('en-US'));
                        $('#ovcpd_endorsement').val(response.ProjectTracker.ovcpd_endorsement ? new Date(response.ProjectTracker.ovcpd_endorsement).toISOString().split('T')[0] : new Date().toLocaleDateString('en-US'));
                        $('#budget_clearance').val(response.ProjectTracker.budget_clearance ? new Date(response.ProjectTracker.budget_clearance).toISOString().split('T')[0] : new Date().toLocaleDateString('en-US'));
                        $('#ovcaf_approval').val(response.ProjectTracker.ovcaf_approval ? new Date(response.ProjectTracker.ovcaf_approval).toISOString().split('T')[0] : new Date().toLocaleDateString('en-US'));

                        $('#opening').val(response.ProjectTracker.opening ? new Date(response.ProjectTracker.opening).toISOString().split('T')[0] : new Date().toLocaleDateString('en-US'));
                        $('#bid_eval').val(response.ProjectTracker.bid_eval ? new Date(response.ProjectTracker.bid_eval).toISOString().split('T')[0] : new Date().toLocaleDateString('en-US'));
                        $('#post_qualification').val(response.ProjectTracker.post_qualification ? new Date(response.ProjectTracker.post_qualification).toISOString().split('T')[0] : new Date().toLocaleDateString('en-US'));
                        $('#bidding').val(response.ProjectTracker.bidding ? new Date(response.ProjectTracker.bidding).toISOString().split('T')[0] : new Date().toLocaleDateString('en-US'));
                        
                        $('#issuance_of_noa').val(response.ProjectTracker.issuance_of_noa ? new Date(response.ProjectTracker.issuance_of_noa).toISOString().split('T')[0] : new Date().toLocaleDateString('en-US'));
                        $('#contract_completion').val(response.ProjectTracker.contract_completion ? new Date(response.ProjectTracker.contract_completion).toISOString().split('T')[0] : new Date().toLocaleDateString('en-US'));
                        $('#notice_to_proceed-plan').val(response.ProjectTracker.notice_to_proceed ? new Date(response.ProjectTracker.notice_to_proceed).toISOString().split('T')[0] : new Date().toLocaleDateString('en-US'));

                        $('#received_proj_folder').val(response.ProjectTracker.received_proj_folder ? new Date(response.ProjectTracker.received_proj_folder).toISOString().split('T')[0] : new Date().toLocaleDateString('en-US'));
                        $('#preconstruction_meet').val(response.ProjectTracker.preconstruction_meet ? new Date(response.ProjectTracker.preconstruction_meet).toISOString().split('T')[0] : new Date().toLocaleDateString('en-US'));
                        $('#percentage_complete').val(response.ProjectTracker.percentage_complete);
                        $('#proj_status').val(response.ProjectTracker.proj_status);
                        $('#payment_status').val(response.ProjectTracker.payment_status);

                        $('#par_ics_attachment').prop('checked', response.ProjectTracker.par_ics_attachment);
                        $('#date_accomplished').val(response.ProjectTracker.date_accomplished ? new Date(response.ProjectTracker.date_accomplished).toISOString().split('T')[0] : new Date().toLocaleDateString('en-US'));
                        
                        $('#contract_end').val(response.ProjectTracker.contract_end ? new Date(response.ProjectTracker.contract_end).toISOString().split('T')[0] : new Date().toLocaleDateString('en-US'));
                        $('#completion_cert').val(response.ProjectTracker.completion_cert ? new Date(response.ProjectTracker.completion_cert).toISOString().split('T')[0] : new Date().toLocaleDateString('en-US'));
                        $('#final_bill_submission').val(response.ProjectTracker.final_bill_submission ? new Date(response.ProjectTracker.final_bill_submission).toISOString().split('T')[0] : new Date().toLocaleDateString('en-US'));
                        $('#par_ics_attachment2').prop('checked', response.ProjectTracker.par_ics_attachment2);
                        $('#date_accomplished_2').val(response.ProjectTracker.date_accomplished_2 ? new Date(response.ProjectTracker.date_accomplished_2).toISOString().split('T')[0] : new Date().toLocaleDateString('en-US'));
                        $('#payment_status_2').val(response.ProjectTracker.payment_status_2);
                        $('#final_bill_payment_received').val(response.ProjectTracker.final_bill_payment_received ? new Date(response.ProjectTracker.final_bill_payment_received).toISOString().split('T')[0] : new Date().toLocaleDateString('en-US'));

                        $('#retention_bill_submission').val(response.ProjectTracker.retention_bill_submission ? new Date(response.ProjectTracker.retention_bill_submission).toISOString().split('T')[0] : new Date().toLocaleDateString('en-US'));
                        $('#retention_bill_payment_received').val(response.ProjectTracker.retention_bill_payment_received ? new Date(response.ProjectTracker.retention_bill_payment_received).toISOString().split('T')[0] : new Date().toLocaleDateString('en-US'));

                        $('#plan-modal-edit').show();
                        $('#plan-modal-form-edit').attr('action', '/form/update/ProjectTracker/' + entryId);
                    } else {
                        $('#plan-modal-add').show();
                    }
                    // console.log(link);
                }
            });
        }

        function deletePlanModal(entryId){
            var link = '/form/delete/ProjectTracker/' + entryId;
            
            $('#plan-modal-delete').attr('action', link);
            $('#plan-modal-del').show();
        }

        function showUpload(){
            var link = '/form/upload/Plan';
            
            $('#modal-bulk-plan').find('#bulk-upload-hook-plan').html(`
            <a href="{{ asset('templates/MasterPlan.xlsx') }}" download="MasterPlan.xlsx" class="csv-download">
                Download Template
            </a>
            `);
            $('#modal-bulk-plan').attr('action', link);
            $('#modal-bulk-plan').show();
        }

        function closePlanModals(){
            $('#plan-modal-add').hide();
            $('#plan-modal-edit').hide();
            $('#plan-modal-del').hide();
            $('#modal-bulk-plan').hide();
            document.body.style.overflow = '';
        }

        $('.close-modal').on('click', function() {
            closePlanModals();
        });

        $('#plan-modal-form-add').on('submit', function(e) {
            e.preventDefault();
            $('#plan-add-form-save-btn').attr('disabled', 'disabled');
            $.ajax({
                url: "/form/add/ProjectTracker",
                method: 'POST',
                data: $('#plan-modal-form-add').serialize(),
                success: function(response) {
                    $('#plan-add-form-save-btn').removeAttr('disabled');
                    $('#plan-modal-add').hide();
                    // localStorage.setItem('success_message', response.success);
                    $('#7324bc4d609c6acab008c8b90fd03a45bfad3218').DataTable().ajax.reload(null, false);
                    closePlanModals();
                    planflashmessage('success', response.success);
                },
                error: function(xhr) {
                    const response = JSON.parse(xhr.responseText);
                    // alert('An error occurred: ' + xhr.responseText);
                    $('#plan-add-form-save-btn').removeAttr('disabled');
                    // localStorage.setItem('message_status', 'error');
                    // localStorage.setItem('message_errors', xhr.responseText.message);
                    planflashmessage('error', response.error);
                }
            });
        });

        $('#plan-modal-form-edit').on('submit', function(e) {
            e.preventDefault();
            $('#plan-edit-form-save-btn').attr('disabled', 'disabled');
            $.ajax({
                url: $('#plan-modal-form-edit').attr('action'),
                method: 'POST',
                data: $('#plan-modal-form-edit').serialize(),
                success: function(response) {
                    $('#plan-edit-form-save-btn').removeAttr('disabled');
                    $('#plan-modal-edit').hide();
                    $('#7324bc4d609c6acab008c8b90fd03a45bfad3218').DataTable().ajax.reload(null, false);
                    closePlanModals();
                    planflashmessage('success', response.success);
                },
                error: function(xhr) {
                    const response = JSON.parse(xhr.responseText);
                    $('#plan-edit-form-save-btn').removeAttr('disabled');
                    planflashmessage('error', response.message);
                }
            });
        });

        $('#plan-modal-delete').on('submit', function(e) {
            e.preventDefault();
            $('#form-del-btn').attr('disabled', 'disabled');
            $.ajax({
                url: $('#plan-modal-delete').attr('action'),
                type: 'DELETE',
                data: $('#plan-modal-delete').serialize(),
                success: function(response) {
                    $('#form-del-btn').removeAttr('disabled');
                    $('#7324bc4d609c6acab008c8b90fd03a45bfad3218').DataTable().ajax.reload(null, false);
                    closePlanModals();
                    planflashmessage('success', response.success);
                },
                error: function(xhr) {
                    const response = JSON.parse(xhr.responseText);
                    $('#form-del-btn').removeAttr('disabled');
                    planflashmessage('error', response.message);
                }
            });
        });

        $('#bulk-upload-form-plan').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData($('#bulk-upload-form-plan')[0]);
            // console.log(formData);
            $('#bulk-upload-btn-plan').attr('disabled', 'disabled');
            $.ajax({
                url: $('#bulk-upload-form-plan').attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#bulk-upload-btn-plan').removeAttr('disabled');
                    $('#7324bc4d609c6acab008c8b90fd03a45bfad3218').DataTable().ajax.reload(null, false);
                    if (Array.isArray(response.errors)) {
                        var errorMessages = response.errors.map(function(errorItem) {
                            var rowNumber = errorItem.row;
                            var errors = errorItem.errors;
                            var formattedErrors = errors.map(function(error) {
                                return 'Row ' + rowNumber + ': ' + error;
                            }).join('<br>');
                            
                            return formattedErrors;
                        }).join('<br>'); 
                        planflashmessage('error', errorMessages);
                    } else {
                        if (response.status === 'error') {
                            planflashmessage('error', response.reponse_message);
                        } else {
                            planflashmessage('success', response.reponse_message);
                        }
                        $('#modal-bulk-plan').hide();
                    }
                },
                error: function(xhr) {
                    const response = JSON.parse(xhr.responseText);
                    $('#bulk-upload-btn-plan').removeAttr('disabled');
                    planflashmessage('error', response.reponse_message);
                }
            });
        });

        $(document).on('click', '.btn-edit-plan', function() {
            var entryId = $(this).data('id');
            document.body.style.overflow = 'hidden';
            showPlanModal(entryId);
        });

        $(document).on('click', '.btn-add-plan', function() {
            document.body.style.overflow = 'hidden';
            showPlanModal();
        });

        $(document).on("click", ".btn-delete-plan", function(){
            var entryId = $(this).data('id');
            deletePlanModal(entryId);
        });

        $(document).on('click', '.btn-bulk-plan', function() {
            // console.log('bulk');
            showUpload();
        });

        var flashPlanMessageElement = $('#plan-flash-message');
        function planflashmessage(status, message) {
            if (message) {
                if(status == 'error'){
                    message+="<br>";

                    flashPlanMessageElement.css('background-color', '#ffcc00');
                    flashPlanMessageElement.css('color', '#000');
                    
                    flashPlanMessageElement.html(message).show();
                } else {
                    flashPlanMessageElement.css('background-color', '#d4edda');
                    flashPlanMessageElement.css('color', '#155724');
                    flashPlanMessageElement.text(message).show();
                }
                setTimeout(function() {
                    flashPlanMessageElement.fadeOut(500);
                }, 11000);
            }
        }
    });
</script>