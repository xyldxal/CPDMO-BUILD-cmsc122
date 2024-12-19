<!DOCTYPE html>

<html>
<head>
    <title>Projects</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/project.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> -->
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

</head>

<div>
    <div class="mt-5">
        <!-- <div class="mb-4 text-center">
            <h3 class="mb-2">All Projects</h3>
            <p>CPDMO BUILD</p>
        </div> -->
        <header class="cd__intro w-100 d-flex align-items-center justify-content-between">
            <h1 class="text-nowrap ml-2">All Projects</h1>
            <div class="" >
                <button class="btn btn-success btn-add mr-1" id="add-button">Add Entry</button>
                <button type="button" class="btn btn-primary btn-bulk btn-bulk-project">
                    <i class="fas fa-file-import"></i>
                </button>
            </div>
        </header>
        <nav class="main-tabs">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-details-main-tab" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">Project Details</button>
                <button class="nav-link" id="nav-accomplishments-main-tab" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">Accomplishments</button>
                <button class="nav-link" id="nav-billing-main-tab" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">Billing</button>
                <button class="nav-link" id="nav-fund-main-tab" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">Fund Sources</button>
                <button class="nav-link" id="nav-dates-main-tab" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">Important Dates</button>
            </div>
        </nav>
        <div class="w-100 pt-0 pr-3">
            <table id="07397d633f25a7101990a75864ae03d5a3b9ac07c4ed6accbc52cbfd7d7c13b4" class="display table table-striped text-nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Project Title</th>
                        <th>Project Description</th>
                        <th>End User</th>
                        <th>Project Status</th>
                        <th>Main Status</th>
                        <th>Accomplishment %</th>
                        <th>Notes</th>
                        <th>Remarks</th>
                        <th>Billing %</th>
                        <th>Total Billings</th>
                        <th>Cost of Completed Works</th>
                        <th>Cost of Remaining Projects</th>
                        <th>Liquidated Damages Booked</th>
                        <th>Total Billed Variation Orders</th>
                        <th>Fund Source</th>
                        <th>Budget</th>
                        <th>Bid Amount</th>
                        <th>Start Date</th>
                        <th>Original Target Date</th>
                        <th>Revised Target Date</th>
                        <th>Original Completion Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <div id="flash-message" class="flash-message"></div>
        </div>
    </div>

    <!-- EDIT Modal HTML -->
    <div class="container mt-4 modal-font">
        <div id="modal-edit" class="modal">
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
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-project-tab-edit" data-bs-toggle="tab" data-bs-target="#nav-project-details" type="button" role="tab" aria-controls="nav-project" aria-selected="true">Project Details</button>
                        <button class="nav-link" id="nav-accomplishments-tab" data-bs-toggle="tab" data-bs-target="#nav-accomplishments" type="button" role="tab" aria-controls="nav-accomplishments" aria-selected="false">Accomplishments</button>
                        <button class="nav-link" id="nav-fund-source-tab" data-bs-toggle="tab" data-bs-target="#nav-fund-source" type="button" role="tab" aria-controls="nav-fund-source" aria-selected="false">Fund Source</button>
                        <button class="nav-link" id="nav-contractors-tab" data-bs-toggle="tab" data-bs-target="#nav-contractors" type="button" role="tab" aria-controls="nav-contractors" aria-selected="false">Contractors</button>
                        <button class="nav-link" id="nav-billing-tab" data-bs-toggle="tab" data-bs-target="#nav-billing" type="button" role="tab" aria-controls="nav-billing" aria-selected="false">Billing</button>
                        <button class="nav-link" id="nav-finance-tab" data-bs-toggle="tab" data-bs-target="#nav-finance" type="button" role="tab" aria-controls="nav-finance" aria-selected="false">Financial Details</button>
                    </div>
                </nav>
                <form id="modal-form-edit" method="POST">
                    @csrf
                    <input type="hidden" id="project_id" name="project_id" value="">
                    <div class="tab-content" id="nav-tabContent-edit">

                        <!-- PROJECT DETAILS -->
                        <div class="tab-pane fade show active" id="nav-project-details" role="tabpanel" aria-labelledby="nav-project-tab-edit">
                            <div class="form-group">
                                <label for="tracking_number">Tracking Number</label>
                                <select id="tracking_number" name="tracking_number" class="tracking_number form-control">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="project_title">Project Title</label>
                                <input type="text" id="project_title" name="project_title" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="project_description">Project Description</label>
                                <input type="text" id="project_description" name="project_description" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="year">Year</label>
                                <input type="number" id="year" name="year" class="form-control" value="<?= date('Y'); ?>">
                            </div>
                            <div class="form-group">
                                <label for="college_unit">Implementing College/Unt</label>
                                <select id="college_unit" name="college_unit" class="college_unit form-control">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="main_status">Main Status</label>
                                <select id="main_status" name="main_status" class="main_status form-control">
                                </select>
                            </div>
                            <input type="hidden" id="pd_project_in_charge_fk" name="pd_project_in_charge_fk" class="form-control" value="" placeholder="" disabled>
                            <div class="form-group">
                                <label for="pd_project_in_charge">Project In Charge</label>
                                <input type="text" id="pd_project_in_charge" name="project_in_charge" class="form-control" value="" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="notice_of_award">Notice of Award</label>
                                <input type="date" id="notice_of_award" name="notice_of_award" class="form-control" value="" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="notice_to_proceed">Notice to Proceed</label>
                                <input type="date" id="notice_to_proceed" name="notice_to_proceed" class="form-control" value="" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="additional_days">Additional Days</label>
                                <input type="number" min-value=0 id="additional_days" name="additional_days" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="contract_duration">Contract Duration</label>
                                <input type="number" min-value=0 id="contract_duration" name="contract_duration" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="approved_budget">Approved Budget</label>
                                <input type="number" min-value=0 step=0.01 id="approved_budget" name="approved_budget" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="bid_price_php">Bid Price</label>
                                <input type="number" min-value=0 step=0.01 id="bid_price_php" name="bid_price_php" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="revised_contract_amount">Revised Contract Amount</label>
                                <input type="number" min-value=0 step=0.01 id="revised_contract_amount" name="revised_contract_amount" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="original_date_of_completion">Original Date of Completion</label>
                                <input type="date" id="original_date_of_completion" name="original_date_of_completion" class="form-control" value="" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="remaining_number_of_days">Remaining Number of Days</label>
                                <input type="number" min-value=0 id="remaining_number_of_days" name="remaining_number_of_days" class="form-control" value="">
                            </div>
                        </div>
                        
                        <!-- ACCOMPLISHMENT -->
                        <div class="tab-pane fade" id="nav-accomplishments" role="tabpanel" aria-labelledby="nav-accomplishments-tab">
                            <div class="form-group">
                                <label for="a_progress">Progress</label>
                                <input type="number" min-value=0 step=0.01 id="a_progress" name="progress" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="a_accomplishments">Accomplishments</label>
                                <input type="text" id="a_accomplishments" name="accomplishments" class="form-control" value="" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="a_as_of">As Of</label>
                                <input type="date" id="a_as_of" name="accomplishment_as_of" class="form-control" value="" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="a_notes">Notes</label>
                                <input type="text" id="a_notes" name="accomplishment_notes" class="form-control" value="" placeholder="">
                            </div>
                        </div>

                        <!-- FUND SOURCE  -->
                        <div class="tab-pane fade" id="nav-fund-source" role="tabpanel" aria-labelledby="nav-fund-source-tab">
                            <div class="form-group">
                                <label for="f_fund_source_id">Fund Source</label>
                                <select id="f_fund_source_id" name="fund_source_id" class="f_fund_source form-control">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="f_is_funded">Is Funded</label>
                                <input type="checkbox" id="f_is_funded" name="is_funded" class="form-checkbox" value="true">
                            </div>
                            <div class="form-group">
                                <label for="f_fund_source_notes">Notes</label>
                                <input type="text" id="f_fund_source_notes" name="fund_source_notes" class="form-control" value="" placeholder="">
                            </div>
                        </div>

                        <!-- CONTRACTOR -->
                        <div class="tab-pane fade" id="nav-contractors" role="tabpanel" aria-labelledby="nav-contractors-tab">
                            <div class="form-group">
                                <label for="daed_contractor">DAED Contractor</label>
                                <input type="text" id="daed_contractor" name="daed_contractor" class="form-control" value="" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="construction_contractor">Construction Contractor</label>
                                <input type="text" id="construction_contractor" name="construction_contractor" class="form-control" value="" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="construction_manager">Construction Manager</label>
                                <input type="text" id="construction_manager" name="construction_manager" class="form-control" value="" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="c_contract_amount">Contract Amount</label>
                                <input type="number" min-value=0 step=0.01 id="c_contract_amount" name="contract_amount" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="contractor">Contractor</label>
                                <input type="text" id="contractor-edit" name="contractor" class="form-control" value="" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="contract_completion_date">Contract Completion Date</label>
                                <input type="date" id="contract_completion_date" name="contract_completion_date" class="form-control" value="" placeholder="">
                            </div>
                        </div>

                        <!-- BILLING -->
                        <div class="tab-pane fade" id="nav-billing" role="tabpanel" aria-labelledby="nav-billing-tab">
                            <div class="form-group">
                                <label for="total_billings">Total Billings</label>
                                <input type="number" min-value=0 step=0.01 id="total_billings" name="total_billings" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="billing_percentage">Billing Percentage</label>
                                <input type="number" min-value=0 step=0.01 id="billing_percentage" name="billing_percentage" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="billed_variation_orders">Billed Variation Orders</label>
                                <input type="number" min-value=0 step=0.01 id="billed_variation_orders" name="billed_variation_orders" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="awarded">Awarded</label>
                                <input type="number" min-value=0 step=0.01 id="awarded" name="awarded" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="percent_savings">Percent Savings</label>
                                <input type="number" min-value=0 step=0.01 id="percent_savings" name="percent_savings" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="billing_as_of">As Of</label>
                                <input type="date" id="billing_as_of" name="billing_as_of" class="form-control" value="" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="billing_notes">Notes</label>
                                <input type="text" id="billing_notes" name="billing_notes" class="form-control" value="" placeholder="">
                            </div>
                        </div>

                        <!-- FINANCIAL DETAILS  -->
                        <div class="tab-pane fade" id="nav-finance" role="tabpanel" aria-labelledby="nav-finance-tab">
                            <div class="form-group">
                                <label for="cost_of_completed_works">Cost of Completed Works</label>
                                <input type="number" min-value=0 step=0.01 id="cost_of_completed_works" name="cost_of_completed_works" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="cost_of_remaining_projects">Cost of Remaining Projects</label>
                                <input type="number" min-value=0 step=0.01 id="cost_of_remaining_projects" name="cost_of_remaining_projects" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="liquidated_damages_booked">Liquidated Damages Booked</label>
                                <input type="number" min-value=0 step=0.01 id="liquidated_damages_booked" name="liquidated_damages_booked" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="total_billed_variation_orders">Total Billed Variation Orders</label>
                                <input type="number" min-value=0 step=0.01 id="total_billed_variation_orders" name="total_billed_variation_orders" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="financing_notes">Notes</label>
                                <input type="text" id="financing_notes" name="financing_notes" class="form-control" value="" placeholder="">
                            </div>
                        </div>
                        <!-- PROJECT DETAILS -->
                        <!-- <div class="tab-pane fade" id="nav-project-details" role="tabpanel" aria-labelledby="nav-project-details-tab">
                            <div class="form-group">
                                <label for="barcode">Barcode</label>
                                <input type="text" id="barcode" name="barcode" class="form-control" value="">
                            </div>

                            <input type="hidden" id="pd_ntp_fk" name="pd_ntp_fk" class="form-control" value="" placeholder="" disabled>
                            <div class="form-group">
                                <label for="pd_notice_to_proceed">Notice to Proceed</label>
                                <input type="date" id="pd_notice_to_proceed" rows="3" name="pd_notice_to_proceed" class="form-control" value="" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="pd_ntp_notes">Notes</label>
                                <textarea id="pd_ntp_notes" name="pd_ntp_notes" class="form-control" value=""></textarea>
                            </div>

                            <input type="hidden" id="pd_noa_fk" name="pd_noa_fk" class="form-control" value="" placeholder="" disabled>
                            <div class="form-group">
                                <label for="pd_notice_of_award">Notice of Award</label>
                                <input type="date" id="pd_notice_of_award" rows="3" name="pd_notice_of_award" class="form-control" value="" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="pd_noa_notes">Notes</label>
                                <textarea id="pd_noa_notes" name="pd_noa_notes" class="form-control" value=""></textarea>
                            </div>

                            <input type="hidden" id="pd_project_fund_source_fk" name="pd_project_fund_source_fk" class="form-control" value="" placeholder="" disabled>
                            <div class="form-group">
                                <label for="pd_project_fund_source">Fund Source</label>
                                <select id="pd_project_fund_source" name="pd_project_fund_source" class="pd_project_fund_source form-control"></select>
                            </div>
                            <div class="form-group">
                                <label for="pd_is_funded">Is funded?</label>
                                <input type="checkbox" id="pd_is_funded" name="pd_is_funded" class="form-checkbox" value="">
                            </div>
                            <div class="form-group">
                                <label for="pd_fund_source_notes">Notes</label>
                                <textarea id="pd_fund_source_notes" name="pd_fund_source_notes" class="form-control" value=""></textarea>
                            </div>

                            

                            <input type="hidden" id="pd_image_fk" name="pd_image_fk" class="form-control" value="" placeholder="" disabled>
                            <div class="form-group">
                                <label for="pd_image">Project Image (URL)</label>
                                <input type="text" id="pd_image" name="pd_image" class="form-control" value="" placeholder="">
                            </div>

                            <input type="hidden" id="pd_geo_fk" name="pd_geo_fk" class="form-control" value="" placeholder="" disabled>
                            <div class="form-group">
                                <label for="pd_long">Geodata (Longitude)</label>
                                <input type="text" id="pd_long" name="pd_long" class="form-control" value="" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="pd_lat">Geodata (Latitude)</label>
                                <input type="text" id="pd_lat" name="pd_lat" class="form-control" value="" placeholder="">
                            </div>
                        </div> -->
                        <!-- <div class="tab-pane fade" id="nav-project-status" role="tabpanel" aria-labelledby="nav-project-status-tab">...</div> -->
                    </div>
                    <hr>
                    <div style="text-align: right;">
                        <button id="edit-form-save-btn" type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL ADD -->
    <div class="container mt-4 modal-font">
        <div id="modal-add" class="modal">
            <div class="modal-title modal-main">
                <div class="grid">
                    <div class="g-col-4">
                        <span class="close close-modal ">&times;</span>
                    </div>
                    <div id="modal-title2" class="h2 g-col-6 g-col-md-4 ms-auto inner-title">Title</div>
                    
                </div>
            </div>
            <div class="modal-content">
            <div class="tab-pane fade show active" id="nav-project" role="tabpanel" aria-labelledby="nav-project-tab">
                <form id="modal-form-add" method="POST" action="/form/add/Project">
                    @csrf
                    <div id="modal-fields">
                        <div class="form-group">
                            <label for="tracking_number">Tracking Number</label>
                            <select id="tracking_number_add" name="tracking_number" class="tracking_number form-control">
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="project_title">Project Title</label>
                            <input type="text" id="project_title_add" name="project_title" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="project_description">Project Description</label>
                            <input type="text" id="project_description_add" name="project_description" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="year">Year</label>
                            <input type="number" id="year_add" name="year" class="form-control" value="<?= date('Y'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="main_status">Main Status</label>
                            <select id="main_status_add" name="main_status" class="main_status form-control">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="college_unit">Implementing College/Unt</label>
                            <select id="college_unit_add" name="college_unit" class="college_unit form-control">
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="notice_of_award">Notice of Award</label>
                            <input type="date" id="notice_of_award_add" name="notice_of_award" class="form-control" value="" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="notice_to_proceed">Notice to Proceed</label>
                            <input type="date" id="notice_to_proceed_add" name="notice_to_proceed" class="form-control" value="" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="additional_days">Additional Days</label>
                            <input type="number" min-value=0 id="additional_days_add" name="additional_days" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="contract_duration">Contract Duration</label>
                            <input type="number" min-value=0 id="contract_duration_add" name="contract_duration" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="approved_budget">Approved Budget</label>
                            <input type="number" min-value=0 step=0.01 id="approved_budget_add" name="approved_budget" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="bid_price_php">Bid Price</label>
                            <input type="number" min-value=0 step=0.01 id="bid_price_php_add" name="bid_price_php" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="revised_contract_amount">Revised Contract Amount</label>
                            <input type="number" min-value=0 step=0.01 id="revised_contract_amount_add" name="revised_contract_amount" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="original_date_of_completion">Original Date of Completion</label>
                            <input type="date" id="original_date_of_completion_add" name="original_date_of_completion" class="form-control" value="" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="remaining_number_of_days">Remaining Number of Days</label>
                            <input type="number" min-value=0 id="remaining_number_of_days_add" name="remaining_number_of_days" class="form-control" value="">
                        </div>
                    </div>
                    <button id="add-form-save-btn" type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
            </div>
        </div>
    </div>

    <!-- Delete Modal HTML -->
    <div class="container mt-4 modal-font">
        <div id="modal-del" class="modal">
            <div class="modal-title modal-main" style="margin-top: 14vh; max-width: 50%;">
                <div class="grid">
                    <div class="g-col-4">
                        <span class="close close-modal ">&times;</span>
                    </div>
                    <div id="delete-modal-title" class="h2 g-col-6 g-col-md-4 ms-auto">Delete Confirmation</div>
                    
                </div>
            </div>
            <div class="modal-content" style="max-width: 50%;">
            
            <div class="modal-body">
                <h6>Are you sure you want to delete this project?</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal" data-bs-dismiss="modal">Cancel</button>
                <form id="modal-delete" method="DELETE">
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
        <div id="modal-bulk" class="modal">
            <div class="modal-title modal-main" style="margin-top: 14vh; max-width: 50%;">
                <div class="grid">
                    <div class="g-col-4">
                        <span class="close close-modal ">&times;</span>
                    </div>
                    <div id="bulk-modal-title" class="h2 g-col-6 g-col-md-4 ms-auto">Bulk Upload</div>
                    
                </div>
            </div>
            <div class="modal-content" style="max-width: 50%;">
                <div class="modal-body">
                    <h6>Only CSV files are supported. Please use the CSV file provided. The first row should be the header</h6>
                    <form id="bulk-upload-form" method="POST" enctype="multipart/form-data" action='/form/upload/Project'>
                        @csrf
                        <div class="mb-3">
                            <input type="file" name="csv_file" class="form-control" accept=".xlsx" required>
                            <p><i>For choices not included in the dropdowns, please add the new choices to the Choices sheet.</i></p>
                        </div>
                    </form>
                    <div id="bulk-upload-hook"></div>
                </div>
                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-secondary close-modal" data-bs-dismiss="modal">Cancel</button>
                    <button id="bulk-upload-btn" type="submit" form="bulk-upload-form" class="btn btn-success">Upload</button>
                </div>
            </div>
        </div>
    </div>

    <div id="flash-message" class="flash-message"></div>
</div>

</html>
<script>
    $(document).ready(function() {
        console.log(@json($jsonFile));
        var table = $('#07397d633f25a7101990a75864ae03d5a3b9ac07c4ed6accbc52cbfd7d7c13b4').DataTable({
            paging: true,
            searching: true,
            responsive: true,
            lengthChange: true,
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
                url: '/Project/c/JSON',
                dataSrc: ''
            },
            columns: [
                // Project Details columns
                { data: 'id', tab: 'details' },
                { data: 'project_title', tab: 'details' },
                { data: 'project_description', tab: 'details' },
                { data: 'end_user', tab: 'details' },
                { data: 'project_status', tab: 'details' },
                { data: 'main_status', tab: 'details' },
                
                // Accomplishments columns
                { data: 'accomplishment_percentage', tab: 'accomplishments' },
                { data: 'notes', tab: 'accomplishments' },
                { data: 'remarks', tab: 'accomplishments' },
                
                // Billing columns
                { data: 'billing_percentage', tab: 'billing' },
                { data: 'total_billings', tab: 'billing' },
                { data: 'cost_of_completed_works', tab: 'billing' },
                { data: 'cost_of_remaining_projects', tab: 'billing' },
                { data: 'liquidated_damages_booked', tab: 'billing' },
                { data: 'total_billed_variation_orders', tab: 'billing' },
                
                // Fund Sources columns
                { data: 'fund_source', tab: 'fund' },
                { data: 'budget', tab: 'fund' },
                { data: 'bid_amount', tab: 'fund' },
                
                // Important Dates columns
                { data: 'start_date', tab: 'dates', 
                    render: (data) => data ? ${String(new Date(data).getDate()).padStart(2, '0')} ${new Date(data).toLocaleString('en-US', { month: 'short' }).toUpperCase()} ${new Date(data).getFullYear()} : '' },
                { data: 'original_target_date', tab: 'dates',
                    render: (data) => data ? ${String(new Date(data).getDate()).padStart(2, '0')} ${new Date(data).toLocaleString('en-US', { month: 'short' }).toUpperCase()} ${new Date(data).getFullYear()} : '' },
                { data: 'revised_target_date', tab: 'dates',
                    render: (data) => data ? ${String(new Date(data).getDate()).padStart(2, '0')} ${new Date(data).toLocaleString('en-US', { month: 'short' }).toUpperCase()} ${new Date(data).getFullYear()} : '' },
                { data: 'original_date_of_completion', tab: 'dates',
                    render: (data) => data ? ${String(new Date(data).getDate()).padStart(2, '0')} ${new Date(data).toLocaleString('en-US', { month: 'short' }).toUpperCase()} ${new Date(data).getFullYear()} : '' },
                
                // Actions column (always visible)
                {
                    data: null,
                    orderable: false,
                    className: "table-fixed",
                    render: function(data, type, row) {
                        return `
                            <a class="edit"><i data-id="${row.id}" class="btn-edit material-icons">&#xE254;</i></a>
                            <a class="delete"><i data-id="${row.id}" class="btn-delete material-icons">&#xE872;</i></a>
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

        function showModal(entryId = null) {
            var counter = entryId === null ? 1 : 0;
            var link = '/form/show/Project' + (entryId ? '/' + entryId : '');
            var action = entryId === null ? 'Add New Project' : 'Edit Project';
            $('.inner-title').text(entryId === null ? 'Add New Project' : 'Edit Project');
            $.ajax({
                url: link,
                method: 'GET',
                success: function(response) {
                    // console.log("START");
                    // console.log(response.CFundSource);

                    const mainStatusSelect = document.getElementsByClassName('main_status')[counter];
                    const collegeSelect = document.getElementsByClassName('college_unit')[counter];
                    const trackNumSelect = document.getElementsByClassName('tracking_number')[counter];
                    const fundSourceSelect = document.getElementsByClassName('f_fund_source')[counter];

                    // console.log(mainStatusSelect, collegeSelect, trackNumSelect, fundSourceSelect);
                    if (mainStatusSelect && collegeSelect && trackNumSelect) {
                        clearOptions();
                        // Populate select elements
                        populateSelect(mainStatusSelect, response.MainStatus, '-- Select Status --');
                        populateSelect(collegeSelect, response.College, '-- Select College / Unit --');
                        populateSelect(trackNumSelect, response.TrackingNumbers, '-- Select Tracking Number --');
                        if (fundSourceSelect) populateSelect(fundSourceSelect, response.CFundSource, '-- Select Fund Source --');
                    } else {
                        console.error("One or more select elements not found");
                    }

                    function clearOptions() {
                        mainStatusSelect.innerHTML = '';
                        collegeSelect.innerHTML = '';
                        trackNumSelect.innerHTML = '';
                        if (fundSourceSelect) fundSourceSelect.innerHTML = '';
                    }

                    function populateSelect(selectElement, valuesArray, defaultText) {
                        const defaultOption = document.createElement('option');
                        defaultOption.value = '';
                        defaultOption.text = defaultText;
                        selectElement.appendChild(defaultOption);

                        valuesArray.forEach(function(unit) {
                            const keys = Object.keys(unit); // Get all keys of the object
                            const valueKey = keys[0]; // Use the first key for the value
                            const textKey = keys[1];

                            const option = document.createElement('option');
                            option.value = unit[valueKey];
                            option.text = unit[textKey].charAt(0).toUpperCase() + unit[textKey].slice(1); 
                            selectElement.appendChild(option);
                        });
                    }

                    console.log(response);
                    if(entryId !== null){
                        // SET DEFAULT VALUES
                        $('#project_id').val(entryId);
                        $('#tracking_number').val(response.Project.tracking_number);
                        $('#project_title').val(response.Project.project_title);
                        $('#project_description').val(response.Project.project_description);
                        $('#year').val(response.Project.year);
                        $('#main_status').val(response.Project.main_status);
                        $('#pd_project_in_charge').val(response.Project.project_in_charge);
                        $('#college_unit').val(response.Project.college_unit);
                        $('#notice_of_award').val(response.Project.notice_of_award ? new Date(response.Project.notice_of_award).toISOString().split('T')[0] : new Date().toLocaleDateString('en-US'));
                        $('#notice_to_proceed').val(response.Project.notice_to_proceed ? new Date(response.Project.notice_to_proceed).toISOString().split('T')[0] : new Date().toLocaleDateString('en-US'));
                        $('#additional_days').val(response.Project.additional_days);
                        $('#contract_duration').val(response.Project.contract_duration);
                        $('#approved_budget').val(response.Project.approved_budget);
                        $('#bid_price_php').val(response.Project.bid_price_php);
                        $('#revised_contract_amount').val(response.Project.revised_contract_amount);
                        $('#original_date_of_completion').val(response.Project.original_date_of_completion ? new Date(response.Project.original_date_of_completion).toISOString().split('T')[0] : new Date().toLocaleDateString('en-US'));
                        $('#remaining_number_of_days').val(response.Project.remaining_number_of_days);
                        
                        if(response.Accomplishment){
                            $('#a_progress').val(response.Accomplishment.progress);
                            $('#a_accomplishments').val(response.Accomplishment.accomplishment);
                            $('#a_as_of').val(response.Accomplishment.as_of ? new Date(response.Accomplishment.as_of).toISOString().split('T')[0] : new Date().toLocaleDateString('en-US'));
                            $('#a_notes').val(response.Accomplishment.notes);
                        }
                        
                        if(response.FundSource){
                            $('#f_fund_source_id').val(response.FundSource.fund_source_id);
                            $('#f_is_funded').prop('checked', response.FundSource.is_funded);
                            $('#f_fund_source_notes').val(response.FundSource.notes);
                        }

                        if(response.ProjectContractor){
                            $('#daed_contractor').val(response.ProjectContractor.daed_contractor);
                            $('#construction_contractor').val(response.ProjectContractor.construction_contractor);
                            $('#construction_manager').val(response.ProjectContractor.construction_manager);
                            $('#c_contract_amount').val(response.ProjectContractor.contract_amount);
                            $('#contractor-edit').val(response.ProjectContractor.contractor);
                            $('#contract_completion_date').val(response.ProjectContractor.contract_completion_date ? new Date(response.ProjectContractor.contract_completion_date).toISOString().split('T')[0] : new Date().toLocaleDateString('en-US'));
                            $('#contactors_as_of').val(response.ProjectContractor.contactors_as_of ? new Date(response.ProjectContractor.contactors_as_of).toISOString().split('T')[0] : new Date().toLocaleDateString('en-US'));
                        }

                        if(response.Billing){
                            $('#total_billings').val(response.Billing.total_billings);
                            $('#billing_percentage').val(response.Billing.billing_percentage);
                            $('#billed_variation_orders').val(response.Billing.billed_variation_orders);
                            $('#awarded').val(response.Billing.awarded);
                            $('#percent_savings').val(response.Billing.percent_savings);
                            $('#billing_as_of').val(response.Billing.as_of ? new Date(response.Billing.as_of).toISOString().split('T')[0] : new Date().toLocaleDateString('en-US'));
                            $('#billing_notes').val(response.Billing.notes);
                        }
                        
                        if(response.FinancialDetail){
                            $('#cost_of_completed_works').val(response.FinancialDetail.cost_of_completed_works);
                            $('#cost_of_remaining_projects').val(response.FinancialDetail.cost_of_remaining_projects);
                            $('#liquidated_damages_booked').val(response.FinancialDetail.liquidated_damages_booked);
                            $('#total_billed_variation_orders').val(response.FinancialDetail.total_billed_variation_orders);
                            $('#financing_notes').val(response.FinancialDetail.notes);
                        }
                        

                        $('#modal-edit').show();
                        $('#modal-form-edit').attr('action', '/form/update/Project/' + entryId);
                    } else {
                        $('#modal-add').modal('show');
                    }
                }
            });
        }

        function deleteModal(entryId){
            var link = '/form/delete/Project/' + entryId;
            
            $('#modal-delete').attr('action', link);
            // console.log($('#modal-delete').attr('action'));
            $('#modal-del').show();
        }

        function closeModals(){
            $('#modal-add').hide();
            $('#modal-edit').hide();
            $('#modal-del').hide();
            $('#modal-bulk').hide();
            document.body.style.overflow = '';
        }

        $('.close-modal').on('click', function() {
            closeModals();
        });

        $('#modal-form-add').on('submit', function(e) {
            e.preventDefault();
            $('#add-form-save-btn').attr('disabled', 'disabled');
            $.ajax({
                url: "/form/add/Project",
                method: 'POST',
                data: $('#modal-form-add').serialize(),
                success: function(response) {
                    $('#add-form-save-btn').removeAttr('disabled');
                    // localStorage.setItem('success_message', response.success);
                    table.ajax.reload(null, false);
                    closeModals();
                    // console.log("success");
                    flashmessage('success', response.success);
                    $('#modal-form-add')[0].reset();
                },
                error: function(xhr) {
                    const response = JSON.parse(xhr.responseText);
                    // alert('An error occurred: ' + xhr.responseText);
                    $('#add-form-save-btn').removeAttr('disabled');
                    // localStorage.setItem('message_status', 'error');
                    // localStorage.setItem('message_errors', xhr.responseText.message);
                    flashmessage('error', response.error);
                }
            });
        });

        $('#modal-form-edit').on('submit', function(e) {
            e.preventDefault();
            $('#edit-form-save-btn').attr('disabled', 'disabled');
            $.ajax({
                url: $('#modal-form-edit').attr('action'),
                method: 'POST',
                data: $('#modal-form-edit').serialize(),
                success: function(response) {
                    $('#edit-form-save-btn').removeAttr('disabled');
                    table.ajax.reload(null, false);
                    
                    if (Array.isArray(response.validation_errors)) {
                        console.log(response.validation_errors);
                        var errorMessages = response.validation_errors.map(function(errorItem) {
                            var rowNumber = errorItem.row;
                            var errors = errorItem.errors;
                            var formattedErrors = errors.map(function(error) {
                                return 'Row ' + rowNumber + ': ' + error;
                            }).join('<br>');
                            
                            return formattedErrors;
                        }).join('<br>'); 
                        flashmessage('error', errorMessages);
                    } else {
                        closeModals();
                        flashmessage('success', response.reponse_message);
                    }
                },
                error: function(xhr) {
                    const response = JSON.parse(xhr.responseText);
                    console.log(response);
                    $('#edit-form-save-btn').removeAttr('disabled');
                    flashmessage('error', response.reponse_message);
                }
            });
        });

        $('#bulk-upload-form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData($('#bulk-upload-form')[0]);
            $('#bulk-upload-btn').attr('disabled', 'disabled');
            $.ajax({
                url: $('#bulk-upload-form').attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#bulk-upload-btn').removeAttr('disabled');
                    table.ajax.reload(null, false);
                    if (Array.isArray(response.errors)) {
                        var errorMessages = response.errors.map(function(errorItem) {
                            var rowNumber = errorItem.row;
                            var errors = errorItem.errors;
                            var formattedErrors = errors.map(function(error) {
                                return 'Row ' + rowNumber + ': ' + error;
                            }).join('<br>');
                            
                            return formattedErrors;
                        }).join('<br>'); 
                        flashmessage('error', errorMessages);
                    } else {
                        // console.error("Errors property is not an array or is missing.");
                        if (response.status === 'error') {
                            flashmessage('error', response.reponse_message);
                        } else {
                            flashmessage('success', response.reponse_message);
                        }
                        $('#modal-bulk').hide();
                    }
                },
                error: function(xhr) {
                    const response = JSON.parse(xhr.responseText);
                    $('#bulk-upload-btn').removeAttr('disabled');
                    flashmessage('error', response.reponse_message);
                }
            });
        });

        function showUpload(){
            var link = '/form/upload/projects';
            
            $('#modal-bulk').find('#bulk-upload-hook').html(`
            <a href="{{ asset('templates/Projects.xlsx') }}" download="Projects.xlsx" class="csv-download">
                Download Template
            </a>
            `);
            $('#modal-bulk').show();
        }

        $('#modal-delete').on('submit', function(e) {
            e.preventDefault();
            $('#form-del-btn').attr('disabled', 'disabled');
            $.ajax({
                url: $('#modal-delete').attr('action'),
                type: 'DELETE',
                data: $('#modal-delete').serialize(),
                success: function(response) {
                    $('#form-del-btn').removeAttr('disabled');
                    table.ajax.reload(null, false);
                    closeModals();
                    flashmessage('success', response.success);
                },
                error: function(xhr) {
                    const response = JSON.parse(xhr.responseText);
                    $('#form-del-btn').removeAttr('disabled');
                    flashmessage('error', response.message);
                }
            });
        });

        $(document).on('click', '.btn-edit', function() {
            var entryId = $(this).data('id');
            // console.log(entryId);
            document.body.style.overflow = 'hidden';
            showModal(entryId);
        });

        $(document).on('click', '.btn-add', function() {
            document.body.style.overflow = 'hidden';
            showModal();
        });

        $(document).on("click", ".btn-delete", function(){
            var entryId = $(this).data('id');
            deleteModal(entryId);
        });

        $(document).on('click', '.btn-bulk-project', function() {
            // console.log('bulk');
            showUpload();
        });

        var flashMessageElement = $('#flash-message');
        function flashmessage(status, message) {
            // console.log(status);
            // console.log(message);
            if (message) {
                if(status == 'error'){
                    message+="<br>";

                    flashMessageElement.css('background-color', '#ffcc00');
                    flashMessageElement.css('color', '#000');
                    
                    flashMessageElement.html(message).show();
                } else {
                    flashMessageElement.css('background-color', '#d4edda');
                    flashMessageElement.css('color', '#155724');
                    flashMessageElement.text(message).show();
                }
                setTimeout(function() {
                    flashMessageElement.fadeOut(500);
                }, 11000);
            }
        }
    });
</script>