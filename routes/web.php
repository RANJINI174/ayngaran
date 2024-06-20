<?php

use Illuminate\Support\Facades\Route;
//Auth
use \App\Http\Controllers\Auth\LoginController;
// end Auth

use \App\Http\Controllers\PincodeController;
use \App\Http\Controllers\UserTypeController;
use \App\Http\Controllers\DirectorController;
use \App\Http\Controllers\MarketingManagerController;
use \App\Http\Controllers\MarketingSupervisorController;
use \App\Http\Controllers\MarketingExecutiveController;
use \App\Http\Controllers\StaffdetailController;
use \App\Http\Controllers\ProjectController;
use \App\Http\Controllers\RelationShipController;
use \App\Http\Controllers\DesignationController;
use \App\Http\Controllers\MarketingTypeController;
use \App\Http\Controllers\BranchController;
use \App\Http\Controllers\DirectionController;
use \App\Http\Controllers\PagesController;
use \App\Http\Controllers\PermissionController;
use \App\Http\Controllers\ProjectDetailController;
use \App\Http\Controllers\EnquiryController;
use \App\Http\Controllers\BookingController;
use \App\Http\Controllers\ProjectVisitController;
use \App\Http\Controllers\PaymentController;
use \App\Http\Controllers\PlotManagementController;
use \App\Http\Controllers\CommissionDetailController;
use \App\Http\Controllers\BankController;
use \App\Http\Controllers\PlotSqftEditController;
use \App\Http\Controllers\PrintTemplateContentController;
use \App\Http\Controllers\PlotRegistrationExpenseController;
use \App\Http\Controllers\ReceiveRegistrationDocumentController;
use \App\Http\Controllers\PlotDocumentIssueController;
use \App\Http\Controllers\LegalBookIssueController;
use \App\Http\Controllers\AccountDayCloseBookController;
use \App\Http\Controllers\LegalDocumentAbstractController;
use \App\Http\Controllers\FullypaidController;
use \App\Http\Controllers\CommissionCashIssueController;
use \App\Http\Controllers\RegistrationCompletedUpdateController;
use \App\Http\Controllers\AccountVoucherEntryController;
use \App\Http\Controllers\MainLedgerController;
use \App\Http\Controllers\SubLedgerController;
use \App\Http\Controllers\VehicleController;
use \App\Http\Controllers\SuspenseDayBookController;
use \App\Http\Controllers\PlotCancelController;
use \App\Http\Controllers\ReportController;
use \App\Http\Controllers\ReportPrintController;
use \App\Http\Controllers\PlotHistoryController;
use \App\Http\Controllers\VacantPlotController;
use \App\Http\Controllers\ProjectAbstractController;
use \App\Http\Controllers\ProjectSummaryController;
use \App\Http\Controllers\MessageController;
use \App\Http\Controllers\SuppliersController;
use \App\Http\Controllers\StudentsController;
use \App\Http\Controllers\CoursesController;
use \App\Http\Controllers\AttendanceController;
use \App\Http\Controllers\CourseStudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// Auth
Route::get('login', [LoginController::class, 'login_form'])->name('login');
Route::post('login-store', [LoginController::class, 'login'])->name('admin_login');


Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('livewire.index');
    });

    Route::get('/index', function () {
        return view('dashboard');
    });
    Route::get('logout', [LoginController::class, 'logout'])->name('admin_logout');


    // User Type
    Route::get('/user-type', [UserTypeController::class, 'index'])->name('user_type.index');
    Route::post('/user-type-store', [UserTypeController::class, 'store'])->name('user_type.store');
    Route::get('user-type/{id}/edit', [UserTypeController::class, 'edit'])->name('user_type.edit');
    Route::put('user-type/{id}', [UserTypeController::class, 'update'])->name('user_type.update');
    Route::delete('user-type/{id}', [UserTypeController::class, 'delete'])->name('user_type.destroy');

    //pincode
    Route::get('pincode-generate/{pincode}', [PincodeController::class, 'pincode_generate'])->name('pincode_generate');

    // Manging Team
    //Directors
    Route::get('/director-lists', [DirectorController::class, 'index'])->name('director_lits');
    Route::get('/director-create', [DirectorController::class, 'create'])->name('director_create');
    Route::post('/director-store', [DirectorController::class, 'store'])->name('director_store');
    Route::get('director/{id}/edit', [DirectorController::class, 'edit'])->name('director_edit');
    Route::put('director/{id}', [DirectorController::class, 'update'])->name('director_update');
    Route::delete('director/{id}', [DirectorController::class, 'delete'])->name('director_destroy');
    Route::get('/getintroducer/{id}', [DirectorController::class, 'introducer_list'])->name('introducer_list');
    Route::get('/getintroducer_id/{id}', [DirectorController::class, 'introducerid_list'])->name('introducerid_list');

    //Marketing manager
    Route::get('/marketing-manager-lists', [MarketingManagerController::class, 'index'])->name('marketing_manager_lits');
    Route::get('/marketing-manager-create', [MarketingManagerController::class, 'create'])->name('marketing_manager_create');
    Route::post('/marketing-manager-store', [MarketingManagerController::class, 'store'])->name('marketing_manager_store');
    Route::get('marketing-manager/{id}/edit', [MarketingManagerController::class, 'edit'])->name('marketing_manager_edit');
    Route::put('marketing-manager/{id}', [MarketingManagerController::class, 'update'])->name('marketing_manager_update');
    Route::delete('marketing-manager/{id}', [MarketingManagerController::class, 'delete'])->name('marketing_manager_destroy');

    //Marketing supervisor
    Route::get('/marketing-supervisor-lists', [MarketingSupervisorController::class, 'index'])->name('marketing_supervisor_lits');
    Route::get('/marketing-supervisor-create', [MarketingSupervisorController::class, 'create'])->name('marketing_supervisor_create');
    Route::post('/marketing-supervisor-store', [MarketingSupervisorController::class, 'store'])->name('marketing_supervisor_store');
    Route::get('marketing-supervisor/{id}/edit', [MarketingSupervisorController::class, 'edit'])->name('marketing_supervisor_edit');
    Route::put('marketing-supervisor/{id}', [MarketingSupervisorController::class, 'update'])->name('marketing_supervisor_update');
    Route::delete('marketing-supervisor/{id}', [MarketingSupervisorController::class, 'delete'])->name('marketing_supervisor_destroy');

    //Marketing executive
    Route::get('/marketing-executive-lists', [MarketingExecutiveController::class, 'index'])->name('marketing_executive_lits');
    Route::get('/marketing-executive-create', [MarketingExecutiveController::class, 'create'])->name('marketing_executive_create');
    Route::post('/marketing-executive-store', [MarketingExecutiveController::class, 'store'])->name('marketing_executive_store');
    Route::get('marketing-executive/{id}/edit', [MarketingExecutiveController::class, 'edit'])->name('marketing_executive_edit');
    Route::put('marketing-executive/{id}', [MarketingExecutiveController::class, 'update'])->name('marketing_executive_update');
    Route::delete('marketing-executive/{id}', [MarketingExecutiveController::class, 'delete'])->name('marketing_executive_destroy');

    //staff details
    Route::get('/staff-details', [StaffdetailController::class, 'index'])->name('staff_detail_lits');
    Route::get('/staff-detail-create', [StaffdetailController::class, 'create'])->name('staff_detail_create');
    Route::post('/staff-detail-store', [StaffdetailController::class, 'store'])->name('staff_detail_store');
    Route::get('staff-detail/{id}/edit', [StaffdetailController::class, 'edit'])->name('staff_detail_edit');
    Route::put('staff-detail/{id}', [StaffdetailController::class, 'update'])->name('staff_detail_update');
    Route::delete('staff-detail/{id}', [StaffdetailController::class, 'delete'])->name('staff_detail_destroy');

    //project
    Route::get('/project-type', [ProjectController::class, 'index'])->name('project_type.index');
    Route::post('/project-type-store', [ProjectController::class, 'store'])->name('project_type.store');
    Route::get('project-type/{id}/edit', [ProjectController::class, 'edit'])->name('project_type.edit');
    Route::put('project-type/{id}', [ProjectController::class, 'update'])->name('project_type.update');
    Route::delete('project-type/{id}', [ProjectController::class, 'delete'])->name('project_type.destroy');

    //Branch
    Route::get('/branch', [BranchController::class, 'index'])->name('branch.index');
    Route::post('/branch-store', [BranchController::class, 'store'])->name('branch.store');
    Route::get('branch/{id}/edit', [BranchController::class, 'edit'])->name('branch.edit');
    Route::put('branch/{id}', [BranchController::class, 'update'])->name('branch.update');
    Route::delete('branch/{id}/delete', [BranchController::class, 'delete'])->name('branch.destroy');

    //relationship
    Route::get('/relationship', [RelationShipController::class, 'index'])->name('relationship.index');
    Route::post('/relationship-store', [RelationShipController::class, 'store'])->name('relationship.store');
    Route::get('/relationship/{id}/edit', [RelationShipController::class, 'edit'])->name('relationship.edit');
    Route::put('relationship/{id}', [RelationShipController::class, 'update'])->name('relationship.update');
    Route::delete('/relationship/{id}', [RelationShipController::class, 'delete'])->name('relationship.destroy');

    //Banks
    Route::get('/bank', [BankController::class, 'index'])->name('bank.index');
    Route::post('/store-bank', [BankController::class, 'store'])->name('bank.store');
    Route::get('/bank/{id}/edit', [BankController::class, 'edit'])->name('bank.edit');
    Route::put('bank/{id}', [BankController::class, 'update'])->name('bank.update');
    Route::delete('/bank/{id}/delete', [BankController::class, 'delete'])->name('bank.destroy');

    //Designation
    Route::get('/designation', [DesignationController::class, 'index'])->name('designation.index');
    Route::post('/designation-store', [DesignationController::class, 'store'])->name('designation.store');
    Route::get('/designation/{id}/edit', [DesignationController::class, 'edit'])->name('designation.edit');
    Route::put('designation/{id}', [DesignationController::class, 'update'])->name('designation.update');
    Route::delete('/designation/{id}', [DesignationController::class, 'delete'])->name('designation.destroy');

    //Direction
    Route::get('/direction', [DirectionController::class, 'index'])->name('direction.index');
    Route::post('/direction-store', [DirectionController::class, 'store'])->name('direction.store');
    Route::get('/direction/{id}/edit', [DirectionController::class, 'edit'])->name('direction.edit');
    Route::put('direction/{id}', [DirectionController::class, 'update'])->name('direction.update');
    Route::delete('/direction/{id}', [DirectionController::class, 'delete'])->name('direction.destroy');

    // Marketing Type
    Route::get('/marketing', [MarketingTypeController::class, 'index'])->name('marketing.index');
    Route::post('/marketing-store', [MarketingTypeController::class, 'store'])->name('marketing.store');
    Route::get('/marketing/{id}/edit', [MarketingTypeController::class, 'edit'])->name('marketing.edit');
    Route::put('marketing/{id}', [MarketingTypeController::class, 'update'])->name('marketing.update');
    Route::delete('/marketing/{id}', [MarketingTypeController::class, 'delete'])->name('marketing.destroy');

    // Pages
    Route::get('/pages', [PagesController::class, 'index'])->name('pages.index');
    Route::post('/store_pages', [PagesController::class, 'store'])->name('pages.store');
    Route::get('/pages/{id}/edit', [PagesController::class, 'edit'])->name('pages.edit');
    Route::put('pages/{id}', [PagesController::class, 'update'])->name('pages.update');
    Route::delete('/pages/{id}/delete', [PagesController::class, 'delete'])->name('pages.destroy');


    // Permissions
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions_list');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('create_permission');
    Route::post('/store/permissions', [PermissionController::class, 'store'])->name('store_permission');
    Route::get('permissions/{id}/edit', [PermissionController::class, 'edit'])->name('edit_permission');
    Route::put('permissions/{id}', [PermissionController::class, 'update'])->name('update_permission');
    Route::delete('permissions/{id}', [PermissionController::class, 'delete'])->name('delete_permission');

    //Print Template
    Route::get('/print-template', [PrintTemplateContentController::class, 'index'])->name('print_template.index');
    Route::post('/print-template-store', [PrintTemplateContentController::class, 'store'])->name('print_template.store');
    Route::get('/print-template/{id}/edit', [PrintTemplateContentController::class, 'edit'])->name('print_template.edit');
    Route::put('print-template/{id}', [PrintTemplateContentController::class, 'update'])->name('print_template.update');
    Route::delete('/print-template/{id}/delete', [PrintTemplateContentController::class, 'delete'])->name('print_template.destroy');

    //vehicles
    Route::get('/vehicle', [VehicleController::class, 'index'])->name('vehicle.index');
    Route::post('/vehicle-store', [VehicleController::class, 'store'])->name('vehicle.store');
    Route::get('/vehicle/{id}/edit', [VehicleController::class, 'edit'])->name('vehicle.edit');
    Route::put('vehicle/{id}', [VehicleController::class, 'update'])->name('vehicle.update');
    Route::delete('/vehicle/{id}/delete', [VehicleController::class, 'delete'])->name('vehicle.destroy');

      //Enquiry
    Route::get('/enquiry-lists', [EnquiryController::class, 'index'])->name('enquiry_lits');
    Route::get('/enquiry-create', [EnquiryController::class, 'create'])->name('enquiry_create');
    Route::post('/enquiry-store', [EnquiryController::class, 'store'])->name('enquiry_store');
    Route::get('enquiry/{id}/edit', [EnquiryController::class, 'edit'])->name('enquiry_edit');
    Route::put('enquiry/{id}', [EnquiryController::class, 'update'])->name('enquiry_update');
    Route::delete('enquiry/{id}', [EnquiryController::class, 'delete'])->name('enquiry_destroy');

    // Project details
    Route::get('/projects', [ProjectDetailController::class, 'index'])->name('projects_list');
    Route::get('/project_create', [ProjectDetailController::class, 'create'])->name('project_create');
    Route::post('/project_store', [ProjectDetailController::class, 'store'])->name('project_store');
    Route::get('project/{id}/edit', [ProjectDetailController::class, 'edit'])->name('project_edit');
    Route::put('project/{id}', [ProjectDetailController::class, 'update'])->name('project_update');
    Route::delete('project/{id}', [ProjectDetailController::class, 'delete'])->name('project_delete');


     // Plot Booking details
    Route::get('/plot-booking', [BookingController::class, 'index'])->name('booking_list');
    Route::get('/booking_create', [BookingController::class, 'create'])->name('booking_create');
    Route::post('/booking_store', [BookingController::class, 'store'])->name('booking_store');
    Route::get('booking/{id}/edit', [BookingController::class, 'edit'])->name('booking_edit');
    Route::post('booking/{id}', [BookingController::class, 'update'])->name('booking_update');
    Route::delete('booking/{id}', [BookingController::class, 'delete'])->name('booking_delete');
    Route::get('booking/{id}/print', [BookingController::class, 'print'])->name('booking_print');
    Route::get('booking/{id}/excel', [BookingController::class, 'excel'])->name('booking_excel');
    Route::get('/get-plot-list/{id}', [BookingController::class, 'plot_list'])->name('plot_list');
    Route::get('/get-marketer-details/{id}', [BookingController::class, 'marketer_list'])->name('marketer_list');
    Route::get('/get-customers/{id}', [BookingController::class, 'customer_list'])->name('customer_list');
    Route::get('/get_plot_details/{project_id}/{plot_id}', [BookingController::class, 'get_plot_details'])->name('get_plot_details');


     // Project Visit details
    Route::get('/project_visit_list', [ProjectVisitController::class, 'index'])->name('project_visit_list');
    Route::get('/project_visit_create', [ProjectVisitController::class, 'create'])->name('project_visit_create');
    Route::post('/project_visit_store', [ProjectVisitController::class, 'store'])->name('project_visit_store');
    Route::get('/get-marketers/{id}', [ProjectVisitController::class, 'marketer_list'])->name('marketer_list');
    Route::get('project_visit/{id}/edit', [ProjectVisitController::class, 'edit'])->name('project_visit_edit');
    Route::post('project_visit/{id}', [ProjectVisitController::class, 'update'])->name('project_visit_update');
    Route::delete('project_visit/{id}', [ProjectVisitController::class, 'delete'])->name('project_visit_delete');
    // Route::get('booking/{id}/edit', [BookingController::class, 'edit'])->name('booking_edit');





    // Plot Cancellation

     Route::get('/plots-list', [PlotCancelController::class, 'index'])->name('plots-list');
     Route::get('/get-cancel-plots-list/{project_id}', [PlotCancelController::class, 'getcancelPlots'])->name('get-cancel-plots-list');
     Route::post('/plots_update/{project_id}/{plot_id}', [PlotCancelController::class, 'update'])->name('plots_update');
     Route::get('plots/{project_id}/{plot_id}/edit', [PlotCancelController::class, 'edit'])->name('plots_edit');


    // Part Payment details
    Route::get('/part_payment_list', [PaymentController::class, 'index'])->name('payment_list');
    Route::get('/create_part_payment', [PaymentController::class, 'create'])->name('booking_create');
    Route::post('/store-payment', [PaymentController::class, 'store'])->name('store-payment');
    Route::get('part_payment/{project_id}/{plot_id}/edit', [PaymentController::class, 'edit'])->name('part_payment_edit');
    Route::get('part_payment/{project_id}/{plot_id}/list', [PaymentController::class, 'list'])->name('part_payment_list');
    Route::post('part_payment/{id}', [PaymentController::class, 'update'])->name('part_payment_update');
    Route::get('part_payment/{id}/{project_id}/{plot_id}/print', [PaymentController::class, 'print'])->name('part_payment_print');
    Route::delete('part_payment/{id}', [PaymentController::class, 'delete'])->name('part_payment_delete');
    Route::get('/get-plots/{id}', [PaymentController::class, 'plot_list'])->name('plot_list');
    Route::get('/get-booking-list/{project_id}/{id}', [PaymentController::class, 'booking_list'])->name('booking_list');
    Route::get('/get-paymode-list/{id}', [PaymentController::class, 'paymode_list'])->name('paymode_list');
    Route::get('/get-paymode-list', [PaymentController::class, 'allpaymode_list'])->name('allpaymode_list');
    Route::get('/customer_bill_list', [PaymentController::class, 'customer_bill'])->name('customer_bill_list');


    //plot management
    Route::get('/plot-management', [PlotManagementController::class, 'index'])->name('plot_management');
    Route::get('/plot-create', [PlotManagementController::class, 'create'])->name('plot_create');
    Route::get('/plot-type-get-val/{id}', [PlotManagementController::class, 'get_type_value'])->name('get_type_value');
    Route::get('/plot-no-auto-fill/{id}', [PlotManagementController::class, 'plot_no_auto_fill'])->name('plot_no_auto_fill');
    Route::post('/plot-store', [PlotManagementController::class, 'store'])->name('plot_store');
    Route::post('/plot-list-view', [PlotManagementController::class, 'plot_list_view'])->name('plot_list_view');
    Route::get('/project-plot-edit/{id}', [PlotManagementController::class, 'project_plot_edit'])->name('project_plot_edit');
    Route::get('/plot/{id}/edit', [PlotManagementController::class, 'edit'])->name('plot_edit');
    Route::put('/plot/{id}', [PlotManagementController::class, 'update'])->name('plot_update');
    Route::delete('/plot/{id}', [PlotManagementController::class, 'delete'])->name('plot_destroy');

    //plot square feet edit
    Route::get('/plot-square-feet/edit', [PlotSqftEditController::class, 'plot_square_feet_edit'])->name('plot_square_feet_edit');
    Route::get('/get-plot-list/{id}/edit', [PlotSqftEditController::class, 'get_plot_list'])->name('get_plot_list');
    Route::get('/get-plot-sqft/{id}', [PlotSqftEditController::class, 'get_plot_sqft'])->name('get_plot_sqft');
    Route::put('/plot-sqft/{id}/update', [PlotSqftEditController::class, 'plot_sqft_update'])->name('plot_sqft_update');

   //commision detail
    Route::get('/commission-details', [CommissionDetailController::class, 'index'])->name('commission_detail');
    Route::get('/commission-detail-create', [CommissionDetailController::class, 'create'])->name('commission_detail_create');
    Route::post('/commission-detail-store', [CommissionDetailController::class, 'store'])->name('commission_detail_store');
    Route::get('/commission-detail/{id}/{plan}/edit', [CommissionDetailController::class, 'edit'])->name('commission_detail_edit');
    Route::put('/commission-detail/{id}', [CommissionDetailController::class, 'update'])->name('commission_detail_update');
    Route::get('/get-commission-details/{id}', [CommissionDetailController::class, 'get_commission_detail'])->name('get_commission_detail');
    Route::get('/get-edit-commission-details/{id}', [CommissionDetailController::class, 'get_edit_commission_detail'])->name('get_edit_commission_detail');
    Route::post('/commission-detail/{id}', [CommissionDetailController::class, 'delete'])->name('commission_detail_destroy');


    //plot registration fully paid list
    Route::get('/fullypaid_list', [FullypaidController::class, 'index'])->name('fullypaid_list');
    Route::get('/get-fullypaid-plot-list/{id}', [FullypaidController::class, 'fullypaid_plot_list'])->name('get-fullypaid-plot-list');
    Route::post('/update_register', [FullypaidController::class, 'update_register'])->name('update_register');
    Route::get('/fullypaid/{id}/{narration}/update', [FullypaidController::class, 'update'])->name('fullypaid.update');


    //plot registration expense confirm
    Route::get('/plot-registration-expense', [PlotRegistrationExpenseController::class, 'index'])->name('plot_registration_expense');
    Route::get('/plot-no-expense-table-lists', [PlotRegistrationExpenseController::class, 'expense_confirm_lists'])->name('plot_registration_expense_table_lists');
    Route::post('/get-registration-expense-detail', [PlotRegistrationExpenseController::class, 'get_plot_registration_detail'])->name("get_plot_registration_detail");
    Route::post('/plot-no-expense-details', [PlotRegistrationExpenseController::class, 'get_plot_no_expense_details'])->name('get_plot_no_expense_details');
    Route::post('/plot-registration-expense-store', [PlotRegistrationExpenseController::class, 'store'])->name('plot_registration_expense_store');

    //receive registration document
    Route::get('/receive-registration-document', [ReceiveRegistrationDocumentController::class, 'index'])->name('receive_registration_document');
    Route::get('/get-register-plot-list/{id}', [ReceiveRegistrationDocumentController::class, 'plot_list'])->name('get-register-plot-list');
    Route::get('/get-mobile/{id}', [ReceiveRegistrationDocumentController::class, 'getMobile'])->name('get-mobile');
    Route::post('/update-document-receive', [ReceiveRegistrationDocumentController::class, 'updateDocumentReceive'])->name('update-document-receive');


    //plot document issue
    Route::get('/plot-document-issue', [PlotDocumentIssueController::class, 'index'])->name('plot_document_issue');
    Route::post('/plot-document-get-plot-nos', [PlotDocumentIssueController::class, 'get_plot_nos'])->name('plot_document_get_plot_nos');
    Route::post('/plot-document-get-plot-sqft', [PlotDocumentIssueController::class, 'get_plot_sqft'])->name('plot_document_get_plot_sqft');
    Route::post('/plot-document-issue-store', [PlotDocumentIssueController::class, 'store'])->name('plot_document_issue_store');

    Route::get('/plot-doc-issue-document', [PlotDocumentIssueController::class, 'plot_doc_issue_page'])->name('plot_doc_issue_page');
    Route::post('/get-plot-doc-issue-document-plots', [PlotDocumentIssueController::class, 'get_document_issue_plots'])->name('get_document_issue_plots');
    Route::post('/plot-document-issue-list-store', [PlotDocumentIssueController::class, 'plot_document_issued_store'])->name('plot_document_issue_list_store');
    //Legal book issue
    Route::get('/legal-book-issue', [LegalBookIssueController::class, 'index'])->name('legal_book_issue');
    Route::get('/get-legal-plots/{id}', [LegalBookIssueController::class, 'plot_list'])->name('plot_list');
    Route::get('/get-legal-details/{project_id}/{id}', [LegalBookIssueController::class, 'plotdetails'])->name('plotdetails');
    Route::post('/update-legal-book', [LegalBookIssueController::class, 'updateLegalBook'])->name('update-legal-book');

    //Legal document abstract
    Route::get('/legal-document-abstract', [LegalDocumentAbstractController::class, 'index'])->name('legal_document_abstract');
    Route::get('/legal-document-abstract-list', [LegalDocumentAbstractController::class, 'legal_abstract_lists'])->name('legal_doc_abstract_lists');

    //commission cash issue
    Route::get('/commission-cash-issue', [CommissionCashIssueController::class, 'index'])->name('commission_cash_issue');
    Route::get('/get-commission-cash-plot-sqft/{project_id}', [CommissionCashIssueController::class, 'get_commission_plot_sqft'])->name('get_commission_plot_sqft');
    Route::post('/commission-cash-get-plots', [CommissionCashIssueController::class, 'get_plot_nos'])->name('commission_cash_get_plot_nos');
    Route::post('/commission-cash-get-marketer', [CommissionCashIssueController::class, 'get_marketer_list'])->name('commission_cash_get_marketer_list');
    Route::get('/get-marketer-comm', [CommissionCashIssueController::class, 'get_marketer_comm'])->name('get_marketer_comm');

    // registration completed updated
    Route::get('/registration-completed-updated', [RegistrationCompletedUpdateController::class, 'index'])->name('registration_com_update');
    Route::get('/registration-completed-get-plots', [RegistrationCompletedUpdateController::class, 'get_plot_nos'])->name('registration_com_get_plot_nos');
    Route::post('/registration-completed-updated-store', [RegistrationCompletedUpdateController::class, 'store'])->name('registration_com_update_store');

    // accounts voucher entry
    Route::get('/account-voucher-entry', [AccountVoucherEntryController::class, 'index'])->name('account-voucher-entry');
    Route::get('/account-voucher-entry-add', [AccountVoucherEntryController::class, 'create'])->name('account-voucher-entry-add');
    Route::get('/account-voucher-entry-edit/{id}/edit', [AccountVoucherEntryController::class, 'edit'])->name('account-voucher-entry-edit');
    Route::post('/account-voucher-entry-store', [AccountVoucherEntryController::class, 'store'])->name('account-voucher-entry-store');
    Route::post('/account-voucher-entry-update/{id}', [AccountVoucherEntryController::class, 'update'])->name('account-voucher-entry-update');
    Route::get('/getsubledger/{id}', [AccountVoucherEntryController::class, 'getsubledger'])->name('getsubledger');
    Route::get('/voucher_print/{id}', [AccountVoucherEntryController::class, 'voucher_print'])->name('voucher_print');
    Route::get('/account-voucher-list', [AccountVoucherEntryController::class, 'voucher_list'])->name('account-voucher-list');

    // accounts day close book
    Route::get('/account-day-close-book', [AccountDayCloseBookController::class, 'index'])->name('account_day_close_book');
    Route::post('/day_book_close_store', [AccountDayCloseBookController::class, 'store'])->name('day_book_close_store');

    // suspense day book
    Route::get('/account-suspense-day-book', [SuspenseDayBookController::class, 'index'])->name('ac_suspense_day_book');
    Route::post('/account-suspense-day-book-store', [SuspenseDayBookController::class, 'store'])->name('account-suspense-day-book-store');
    Route::get('account-suspense-day-book/{id}/{from_date}/{to_date}/print', [SuspenseDayBookController::class, 'print'])->name('ccount-suspense-day-book-print');



    //Main ledger
    Route::get('/main-ledger', [MainLedgerController::class, 'index'])->name('main.index');
    Route::post('/main-ledger-store', [MainLedgerController::class, 'store'])->name('main.store');
    Route::get('/main/{id}/edit', [MainLedgerController::class, 'edit'])->name('main.edit');
    Route::put('main/{id}', [MainLedgerController::class, 'update'])->name('main.update');
    Route::delete('/main/{id}/delete', [MainLedgerController::class, 'delete'])->name('main.destroy');

    //Sub ledger
    Route::get('/sub-ledger', [SubLedgerController::class, 'index'])->name('sub.index');
    Route::post('/sub-ledger-store', [SubLedgerController::class, 'store'])->name('sub.store');
    Route::get('/sub/{id}/edit', [SubLedgerController::class, 'edit'])->name('sub.edit');
    Route::put('sub/{id}', [SubLedgerController::class, 'update'])->name('sub.update');
    Route::delete('/sub/{id}/delete', [SubLedgerController::class, 'delete'])->name('sub.destroy');

    //commission cash issue
    Route::get('/commission-cash-issue', [CommissionCashIssueController::class, 'index'])->name('commission_cash_issue');
    Route::post('/commission-cash-issue-store', [CommissionCashIssueController::class, 'store'])->name('commission_cash_issue_store');
    Route::post('/commission-cash-get-plots', [CommissionCashIssueController::class, 'get_plot_nos'])->name('commission_cash_get_plot_nos');
    Route::post('/commission-cash-get-marketer', [CommissionCashIssueController::class, 'get_marketer_list'])->name('commission_cash_get_marketer_list');
    Route::get('/get-marketer-comm', [CommissionCashIssueController::class, 'get_marketer_comm'])->name('get_marketer_comm');
    Route::get('/get-marketer-history', [CommissionCashIssueController::class, 'get_marketer_history'])->name('get_marketer_history');

    // Message
    Route::get('/message-template', [MessageController::class, 'index'])->name('message-template');
    Route::post('/send-message', [MessageController::class, 'send'])->name('send-message');

    //Reports
    Route::get('/project-history', [ReportController::class, 'projectHistory'])->name('project-history');
    Route::get('/project-history/{id}/print', [ReportController::class, 'printProjectHistory'])->name('project_history_print');
    Route::get('/get-plot-details/{id}', [ReportController::class, 'plotDetails'])->name('get-plot-details');
    Route::get('/project-sales-list', [ReportController::class, 'projectSalesList'])->name('project-sales-list');
    Route::get('/project-sales-list/print', [ReportController::class, 'printSalesList'])->name('sales_list_print');
    Route::get('/marketer-status-report', [ReportController::class, 'marketerStatusReport'])->name('marketer-status-report');
    Route::get('/plots-booking-registered-list', [ReportController::class, 'bookingRegisteredList'])->name('plots-booking-registered-list');
    Route::get('/plots-booking/{from_date}/{to_date}/print', [ReportPrintController::class, 'printBookingRegistered'])->name('plots-booking-registered-list-print');
    Route::get('/project-details', [ReportController::class, 'projectDetailsList'])->name('project-details');
    Route::get('/site-visit-details', [ReportController::class, 'siteVisitDetailsList'])->name('site-visit-details');
    Route::get('/cancel-plots-list', [ReportController::class, 'cancelPlots'])->name('cancel-plots-list');
    Route::get('/get-cancel-plots/{id}', [ReportController::class, 'cance_plot_list'])->name('get-cancel-plots');
    Route::get('/get-cancel-plots-list/{project_id}/{plot_id}', [ReportController::class, 'getcancelPlots'])->name('get-cancel-plots-list');
    Route::get('/cancel_plot_print/{project_id}/{plot_id}', [ReportController::class, 'cancelled_plot_print'])->name('cancel_plot_print'); // updated by Gowtham.s

    Route::get('/plot_history', [PlotHistoryController::class, 'index'])->name('plot_history');
    Route::post('/get_plot_history_plots', [PlotHistoryController::class, 'get_plot_nos'])->name('get_plot_history_plots');
    Route::post('/get_plot_history', [PlotHistoryController::class, 'get_plot_history'])->name('get_plot_history');
    Route::get('/plot_history_print/{project_id}/{plot_id}/list', [PlotHistoryController::class, 'plot_history_print_list'])->name('plot_history_print');

    Route::get('/vacant_plot_detail', [VacantPlotController::class, 'index'])->name('vacant_plot_detail');
    Route::post('/get_vacant_plots', [VacantPlotController::class, 'get_vacant_plots'])->name('get_vacant_plots');
     Route::get('/vacant_plots_print/{project_id}/list', [VacantPlotController::class, 'vacant_plots_print_lists'])->name('vacant_plots_print');

    Route::get('/project_summary', [ProjectSummaryController::class, 'index'])->name('project_summary');
    Route::post('/get_project_summary', [ProjectSummaryController::class, 'get_project_summary'])->name('get_project_summary');

    Route::get('/project_abstract', [ProjectAbstractController::class, 'index'])->name('project_abstract');


    // Suppliers
    // Route::post('/suppliers', [SuppliersController::class, 'store'])->name('suppliers.store');
    Route::get('/suppliers', [SuppliersController::class, 'index'])->name('suppliers.index');
    // Route::get('/suppliers/create', [SuppliersController::class, 'create'])->name('suppliers.create');
    Route::post('/suppliers/store', [SuppliersController::class, 'store'])->name('suppliers.store');
    Route::get('/suppliers/{id}/edit', [SuppliersController::class, 'edit'])->name('suppliers.edit');
    Route::put('suppliers/{id}', [SuppliersController::class, 'update'])->name('suppliers.update');
    Route::delete('/suppliers/{id}/delete', [SuppliersController::class, 'delete'])->name('suppliers.destroy');


    // Students

    Route::get('/students', [StudentsController::class, 'index'])->name('students.index');
    Route::post('/students/store', [StudentsController::class, 'store'])->name('students.store');
    Route::get('/students/{id}/edit', [StudentsController::class, 'edit'])->name('students.edit');
    Route::put('students/{id}', [StudentsController::class, 'update'])->name('students.update');
    Route::delete('/students/{id}/delete', [StudentsController::class, 'delete'])->name('students.destroy');


    // Courses

    Route::get('/courses', [CoursesController::class, 'index'])->name('courses.index');
    Route::post('/courses/store', [CoursesController::class, 'store'])->name('courses.store');
    Route::get('/courses/{id}/edit', [CoursesController::class, 'edit'])->name('courses.edit');
    Route::put('courses/{id}', [CoursesController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{id}/delete', [CoursesController::class, 'delete'])->name('courses.destroy');

    //attendance
    // Route::resource('attendance', 'AttendanceController');
    Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendances.index');
    Route::post('/attendances/store', [AttendanceController::class, 'store'])->name('attendances.store');
    Route::get('/attendances/{id}/edit', [AttendanceController::class, 'edit'])->name('attendances.edit');
    Route::put('attendances/{id}', [AttendanceController::class, 'update'])->name('attendances.update');
    Route::delete('/attendances/{id}/delete', [AttendanceController::class, 'delete'])->name('attendances.destroy');


   //CourseStudent

   Route::get('course_students', [CourseStudentController::class, 'index'])->name('course_students.index');
   Route::post('/course_students/store', [CourseStudentController::class, 'store'])->name('course_students.store');
   Route::post('enroll_student', [CourseStudentController::class, 'enrollStudent'])->name('course_students.enroll');
   Route::post('unenroll_student', [CourseStudentController::class, 'unenrollStudent'])->name('course_students.unenroll');
   Route::get('student_courses/{student}', [CourseStudentController::class, 'studentCourses'])->name('course_students.student_courses');
   Route::get('course_students/{course}', [CourseStudentController::class, 'courseStudents'])->name('course_students.course_students');
   Route::post('update_enrollment', [CourseStudentController::class, 'updateEnrollment'])->name('course_students.update_enrollment');


   Route::post('/course_students/enroll', [CourseStudentController::class, 'enrollStudent'])->name('course_students.enroll');
   Route::post('/course_students/unenroll', [CourseStudentController::class, 'unenrollStudent'])->name('course_students.unenroll');
   Route::post('/course_students/update_enrollment', [CourseStudentController::class, 'updateEnrollment'])->name('course_students.update_enrollment');


//    Route::post('course_students', [CourseStudentController::class, 'store'])->name('course_students.store');
//    Route::put('course_students/{id}', [CourseStudentController::class, 'update'])->name('course_students.update');
//    Route::get('/course_students/{id}/edit', [CourseStudentController::class, 'edit'])->name('course_students.edit');
//    Route::delete('/course_students/{id}/delete', [CourseStudentController::class, 'delete'])->name('course_students.destroy');

Route::post('course_students', [CourseStudentController::class, 'store'])->name('course_students.store');
 Route::put('course_students/{student_id}/{course_id}', [CourseStudentController::class, 'update'])->name('course_students.update');
Route::put('/course_students/{student_id}/{course_id}', [CourseStudentController::class, 'update']);
Route::get('course_students/{student_id}/{course_id}/edit', [CourseStudentController::class, 'edit'])->name('course_students.edit');
Route::delete('course_students/{student_id}/{course_id}/delete', [CourseStudentController::class, 'delete'])->name('course_students.destroy');



//compisite key
Route::put('/course_students/{student_id}/{course_id}', [CourseStudentController::class, 'update']);
Route::get('/course_students/{student_id}/{course_id}/edit', [CourseStudentController::class, 'edit']);


   Route::post('/students/{studentId}/courses', [CourseStudentController::class, 'enrollStudent'])->name('students.courses.enroll');
    Route::delete('/students/{studentId}/courses/{courseId}', [CourseStudentController::class, 'unenrollStudent'])->name('students.courses.unenroll');
    Route::get('/students/{studentId}/courses', [CourseStudentController::class, 'studentCourses'])->name('students.courses.list');
    Route::get('/courses/{courseId}/students', [CourseStudentController::class, 'courseStudents'])->name('courses.students.list');


    Route::post('students/{student_id}/courses', [StudentsController::class, 'enrollCourse']);
    Route::delete('students/{student_id}/courses/{course_id}', [StudentsController::class, 'unenrollCourse']);
    Route::get('students/{student_id}/attendance', [StudentsController::class, 'attendanceReport']);

    Route::get('courses/{course_id}/attendance', [CoursesController::class, 'attendanceReport']);
    Route::post('attendance/generateReport', [AttendanceController::class, 'generateReport']);

});
