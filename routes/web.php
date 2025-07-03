<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
// Super Admin 
use App\Http\Controllers\W3crmAdminController;
// Admin 
use App\Http\Controllers\AdminMain\SalesController;
use App\Http\Controllers\AdminMain\EnquiryController;
use App\Http\Controllers\AdminMain\PurchaseController;
use App\Http\Controllers\AdminMain\DSRReportController;
use App\Http\Controllers\AdminMain\MasterBankController;
use App\Http\Controllers\AdminMain\MasterPortController;
use App\Http\Controllers\AdminMain\MemberUserController;
use App\Http\Controllers\AdminMain\FixedChargeController;
use App\Http\Controllers\AdminMain\PackingListController;
use App\Http\Controllers\AdminMain\MasterBlTypeController;
use App\Http\Controllers\AdminMain\MasterChargeController;
use App\Http\Controllers\AdminMain\MasterVoyageController;
use App\Http\Controllers\AdminMain\CompanyBranchController;
use App\Http\Controllers\AdminMain\MasterPackageController;
use App\Http\Controllers\SuperAdminMain\AdminFaqController;
use App\Http\Controllers\SuperAdminMain\InvoicesController;
use App\Http\Controllers\SuperAdminMain\PackagesController;
use App\Http\Controllers\AdminMain\CompanySettingController;
use App\Http\Controllers\AdminMain\MasterShippingController;
use App\Http\Controllers\AdminMain\SalesTDSReportController;
use App\Http\Controllers\AdminMain\SallesRegisterController;
use App\Http\Controllers\AdminMain\Vessels\VesselController;
use App\Http\Controllers\SuperAdminMain\CompaniesController;
use App\Http\Controllers\AdminMain\MasterContainerController;
use App\Http\Controllers\AdminMain\MembersUserRoleController;
use App\Http\Controllers\AdminMain\GstPayableReportController;
use App\Http\Controllers\AdminMain\PurchaseRegisterController;
use App\Http\Controllers\AdminMain\SacSummaryReportController;
use App\Http\Controllers\AdminMain\MasterExportPartyController;
use App\Http\Controllers\AdminMain\MasterImportPartyController;
use App\Http\Controllers\SuperAdminMain\FrontSettingController;
use App\Http\Controllers\AdminMain\Operations\BookingController;
use App\Http\Controllers\AdminMain\ProductivityReportController;
use App\Http\Controllers\AdminMain\MasterContainerSizeController;
use App\Http\Controllers\AdminMain\PurchaseOutstandingController;
use App\Http\Controllers\AdminMain\DeliveryAdviceReportController;

use App\Http\Controllers\AdminMain\Operations\AirImportController;
use App\Http\Controllers\AdminMain\Operations\JobMasterController;
use App\Http\Controllers\AdminMain\Operations\TransportController;
use App\Http\Controllers\AdminMain\Operations\UploadedFileController;
use App\Http\Controllers\AdminMain\Operations\ExportBlEntryController;
use App\Http\Controllers\AdminMain\Operations\AirExportController;
use App\Http\Controllers\AdminMain\Operations\SeaExportController;
use App\Http\Controllers\AdminMain\Operations\SeaImportController;
use App\Http\Controllers\AdminMain\Operations\SeaImportDataEntryController;
use App\Http\Controllers\AdminMain\Operations\CommonFormsController;
use App\Http\Controllers\AdminMain\Operations\JobOpenCloseController;
use App\Http\Controllers\AdminMain\Operations\CommanMultiFilesUploadController;

use App\Http\Controllers\AdminMain\Accounts\SalesInvoiceController;
use App\Http\Controllers\AdminMain\Accounts\ReceiptController;
use App\Http\Controllers\AdminMain\Accounts\PurchasePaymentController;
use App\Http\Controllers\AdminMain\Accounts\OnAccountController;
use App\Http\Controllers\AdminMain\Accounts\PurchaseInvoiceController;
use App\Http\Controllers\AdminMain\Accounts\ProformaInvoiceController;

use App\Http\Controllers\AdminMain\Reports\LoadingListController;
use App\Http\Controllers\AdminMain\Reports\SalesOutstandingController;
use App\Http\Controllers\AdminMain\Reports\PurchaseTDSReportController;
use App\Http\Controllers\AdminMain\Reports\PurchaseLedgerController;
use App\Http\Controllers\AdminMain\Reports\ReceiptLedgerController;
use App\Http\Controllers\AdminMain\Reports\CostSheetReportController;

// PUBLIC ROUTES (Login, Register, Forgot Password)
Route::controller(W3crmAdminController::class)->group(function () {
    Route::get('/', 'page_login')->name('login');
    Route::get('register', 'page_register');
    Route::get('page-forgot-password', 'page_forgot_password');
    Route::post('/admin/login', 'login')->name('admin.login');
});


// PROTECTED ROUTES (LOGGED IN)
Route::middleware('auth')->group(function () {

    Route::controller(W3crmAdminController::class)->group(function () {
        Route::get('/page-error-400', 'page_error_400');
        Route::get('/page-error-403', 'page_error_403');
        Route::get('/page-error-404', 'page_error_404');
        Route::get('/page-error-500', 'page_error_500');
        Route::get('/page-error-503', 'page_error_503');
        Route::get('/logout', 'logout')->name('logout');
    });

    // DashBoard Related Route
    Route::get('/admin/dashboard', [W3crmAdminController::class, 'dashboard_2'])->name('dashboard');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::get('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.read');

    // SUPER ADMIN SECTION
    // Route::get('/super-admin/dashboard', 'dashboard');
    Route::get('/packages', [PackagesController::class, 'index']);
    Route::get('/packages/create', [PackagesController::class, 'create']);
    Route::get('/packages/{id}/edit', [PackagesController::class, 'edit']);

    Route::get('/companies', [CompaniesController::class, 'index']);
    Route::get('/companies/create', [CompaniesController::class, 'create']);
    Route::get('/companies/{id}/edit', [CompaniesController::class, 'edit']);

    Route::get('/invoices', [InvoicesController::class, 'index']);

    Route::get('/admin-faq', [AdminFaqController::class, 'index']);
    Route::get('/admin-faq/create', [AdminFaqController::class, 'create']);
    Route::get('/admin-faq/{id}/edit', [AdminFaqController::class, 'edit']);

    Route::get('/contact-setting', [FrontSettingController::class, 'contactsetting']);
    Route::get('/footer-setting', [FrontSettingController::class, 'footersetting']);

    // (1) Master routes
    Route::middleware(['permission:masters'])->group(function(){

        Route::prefix('admin')->group(function () {

            Route::resource('vessels', VesselController::class);
            Route::resource('ports', MasterPortController::class);
            Route::resource('shippings', MasterShippingController::class);
            Route::resource('voyages', MasterVoyageController::class);
            Route::resource('packages', MasterPackageController::class);
            Route::resource('import-parties', MasterImportPartyController::class);
            Route::resource('export-parties', MasterExportPartyController::class);
            Route::resource('charges', MasterChargeController::class);
            Route::resource('containers', MasterContainerController::class);
            Route::resource('container-sizes', MasterContainerSizeController::class);
            Route::resource('bl-types', MasterBlTypeController::class);
            Route::resource('banks', MasterBankController::class);

        });

    });

   
   // (2) opreration routes

    Route::post('/salesperson/store', [CommonFormsController::class, 'addSalesPerson'])->name('salesperson.store');

    Route::POST('multi-file-upload', [CommanMultiFilesUploadController::class, 'updateFileUpload'])->name('multi-file-upload.updateFileUpload'); 
    Route::post('multi-file-upload/search-file', [CommanMultiFilesUploadController::class, 'searchFile'])->name('multi-file-upload.searchFile');
    Route::get('multi-file-upload/download/{id}', [CommanMultiFilesUploadController::class, 'downloadFile'])->name('multi-file-upload.downloadFile');
    Route::delete('multi-file-upload/{id}', [CommanMultiFilesUploadController::class, 'destroy'])->name('multi-file-upload.delete');

    // bookings related routes
    Route::POST('bookings.add-container', [BookingController::class, 'addContainer'])->name('bookings.addContainer');   
    Route::POST('bookings.file-upload', [BookingController::class, 'fileUpload'])->name('bookings.fileUpload');   
    Route::post('/bookings/search-file', [BookingController::class, 'searchFile'])->name('bookings.searchFile');
    Route::get('bookings/download/{id}', [BookingController::class, 'downloadFile'])->name('bookings.downloadFile');
    Route::put('bookings/update-container/{id}', [BookingController::class, 'updateContainer'])->name('bookings.updateContainer');
    Route::get('/booking/print/{id}', [BookingController::class, 'print'])->name('booking.print');


    // Air Import related routes
    Route::put('air-imports/updateHawb', [AirImportController::class, 'updateHawb'])->name('air-imports.updateHawb');   
    Route::put('air-imports/updateother', [AirImportController::class, 'updateother'])->name('air-imports.updateother');   
   
    // Sea Import related routes
    Route::post('sea-imports/add-container', [SeaImportController::class, 'addContainer'])->name('sea-imports.addContainer');   
    Route::put('sea-imports/update-container/{id}', [SeaImportController::class, 'updateContainer'])->name('sea-imports.updateContainer');

    // Sea Export related routes
    Route::post('sea-exports.add-container', [SeaExportController::class, 'addContainer'])->name('sea-exports.addContainer');   
    Route::put('sea-exports.update-container/{id}', [SeaExportController::class, 'updateContainer'])->name('sea-exports.updateContainer');

    // transport related routes
    Route::post('transports.add-container', [TransportController::class, 'addContainer'])->name('transports.addContainer');   
    Route::put('transports.update-container/{id}', [TransportController::class, 'updateContainer'])->name('transports.updateContainer');

    // Sea Import Data Entry related routes
    Route::post('sea-import-data-entry/add-container', [SeaImportDataEntryController::class, 'addContainer'])->name('sea-import-data-entry.addContainer');   
    Route::put('sea-import-data-entry/update-container/{id}', [SeaImportDataEntryController::class, 'updateContainer'])->name('sea-import-data-entry.updateContainer');

    // Common Model Forms  Route
    Route::post('add-vessel', [CommonFormsController::class, 'CommonVesselForms'])->name('new-vessels.store');
    Route::post('add-party', [CommonFormsController::class, 'CommonPartyForms'])->name('new-party.store');
    Route::post('add-port', [CommonFormsController::class, 'CommonPortForms'])->name('new-port.store');
    Route::post('add-package', [CommonFormsController::class, 'CommonPackageForms'])->name('new-package.store');
    Route::post('/get-job-details', [CommonFormsController::class, 'getJobDetails']);
    
    //Job Open Close Route
    Route::post('/job-open-close/filter', [JobOpenCloseController::class, 'filter'])->name('job-open-close.filter');
    Route::post('/job-open-close/bulk-update', [JobOpenCloseController::class, 'bulkUpdate'])->name('job-open-close.bulkUpdate');
    
    
    Route::middleware(['permission:operations'])->group(function(){
        Route::prefix('admin')->group(function(){

            Route::resource('bookings', BookingController::class);       
            Route::resource('job-masters', JobMasterController::class);  
            Route::resource('job-open-close', JobOpenCloseController::class); 

            Route::resource('air-imports', AirImportController::class);   
            Route::resource('air-exports', AirExportController::class);  

            Route::resource('sea-imports', SeaImportController::class);   
            Route::resource('sea-exports', SeaExportController::class);   

            Route::resource('sea-import-data-entry', SeaImportDataEntryController::class);       
            Route::resource('export-bl-entry', ExportBlEntryController::class);       
            Route::resource('transports', TransportController::class);       

            Route::get('/Enquiry', [EnquiryController::class, 'index']);
            Route::get('/Enquiry/create', [EnquiryController::class, 'create']);
            Route::get('/Enquiry/{id}/edit', [EnquiryController::class, 'edit']);
            
            Route::get('/PackingList', [PackingListController::class, 'index']);
            Route::get('/PackingList/create', [PackingListController::class, 'create']);
            Route::get('/PackingList/{id}/edit', [PackingListController::class, 'edit']);

            Route::get('/upload-files', [UploadedFileController::class, 'index'])->name('files.index');
            Route::post('/upload-files', [UploadedFileController::class, 'store'])->name('files.store');
            Route::get('/upload-files/download/{id}', [UploadedFileController::class, 'download'])->name('files.download');
            Route::delete('/upload-files/{id}', [UploadedFileController::class, 'destroy'])->name('files.destroy');
                        
            Route::get('/FixedCharge', [FixedChargeController::class, 'index']);
            Route::get('/FixedCharge/create', [FixedChargeController::class, 'create']);
            Route::get('/FixedCharge/{id}/edit', [FixedChargeController::class, 'edit']);
            
        });
    });

    // (3) Account routes
    
    // Sales Invoice routes
    Route::post('sales-invoices/job-numbers', [SalesInvoiceController::class, 'getJobNo'])->name('sales-invoices.getJobNo');
    Route::post('sales-invoices/invoice-record', [SalesInvoiceController::class, 'getInvoiceRecord'])->name('sales-invoices.getInvoiceRecord');
    Route::post('sales-invoices/charges', [SalesInvoiceController::class, 'salesInvoiceCharge'] )->name('sales-invoices.salesInvoiceCharge');
    Route::put('sales-invoices/charges/{id}', [SalesInvoiceController::class, 'UpdateSalesInvoiceCharge'] )->name('sales-invoices.UpdateSalesInvoiceCharge');

    // Purchase Invoice routes
    Route::post('purchase-invoices/job-numbers', [PurchaseInvoiceController::class, 'getJobNo'])->name('purchase-invoices.getJobNo');
    Route::post('purchase-invoices/invoice-record', [PurchaseInvoiceController::class, 'getInvoiceRecord'])->name('purchase-invoices.getInvoiceRecord');
    Route::post('purchase-invoices/charges', [PurchaseInvoiceController::class, 'purchaseInvoiceCharge'] )->name('purchase-invoices.purchaseInvoiceCharge');
    Route::put('purchase-invoices/charges/{id}', [PurchaseInvoiceController::class, 'UpdatePurchaseInvoiceCharge'] )->name('purchase-invoices.UpdatePurchaseInvoiceCharge');

    // Proforma Invoice routes
    Route::post('proforma-invoices/job-numbers', [ProformaInvoiceController::class, 'getJobNo'])->name('proforma-invoices.getJobNo');
    Route::post('proforma-invoices/invoice-record', [ProformaInvoiceController::class, 'getInvoiceRecord'])->name('proforma-invoices.getInvoiceRecord');
    Route::post('proforma-invoices/charges', [ProformaInvoiceController::class, 'proformaInvoiceCharge'] )->name('proforma-invoices.proformaInvoiceCharge');
    Route::put('proforma-invoices/charges/{id}', [ProformaInvoiceController::class, 'UpdateProformaInvoiceCharge'] )->name('proforma-invoices.UpdateProformaInvoiceCharge');

    // receipts routes
    Route::match(['post','put'], 'receipts-payment-details/{id}', [ReceiptController::class, 'paymentDetails'] )->name('receipts.paymentDetails');

    // Purchase Paymen Route
    Route::match(['post','put'], 'purchase-payment-details/{id}', [PurchasePaymentController::class, 'paymentDetails'] )->name('purchase-payment.paymentDetails');

    Route::middleware(['permission:accounts'])->group(function(){
        Route::prefix('admin')->group(function(){
            Route::resource('sales-invoices', SalesInvoiceController::class);
            Route::resource('purchase-invoices', PurchaseInvoiceController::class);
            Route::resource('proforma-invoices', ProformaInvoiceController::class);
            
            Route::resource('receipts', ReceiptController::class);
            Route::resource('purchase-payment', PurchasePaymentController::class);
            Route::resource('on-accounts', OnAccountController::class);   

            Route::post('file-upload', [FileUploadController::class, 'updateFileUpload'])->name('file-upload.updateFileUpload');
            Route::post('search-file', [FileUploadController::class, 'searchFile'])->name('file-upload.searchFile');
            Route::get('download/{id}', [FileUploadController::class, 'downloadFile'])->name('file-upload.downloadFile');
        });
    });

    //(4) Report routes
    Route::middleware(['permission:reports'])->group(function () { 
        Route::prefix('admin')->group(function(){       
            
            Route::get('/loading-list', [LoadingListController::class, 'index']);
            Route::post('/loading-list/preview', [LoadingListController::class, 'preview'])->name('loading-list.preview');
            Route::get('/loading-list/download/{format}', [LoadingListController::class, 'download'])->name('loading-list.download');
        
            Route::get('/cost-sheet-report', [CostSheetReportController::class, 'index']);
            Route::match(['get', 'post'], '/cost-sheet-report/preview', [CostSheetReportController::class, 'preview'])->name('cost-sheet-report.preview');
            Route::get('/cost-sheet-report/download/{format}', [CostSheetReportController::class, 'download'])->name('cost-sheet-report.download');
            
            Route::get('/sales-outstanding', [SalesOutstandingController::class, 'index']);
            Route::match(['get', 'post'], '/sales-outstanding/preview', [SalesOutstandingController::class, 'preview'])->name('sales-outstanding.preview');
            Route::get('/sales-outstanding/download/{format}', [SalesOutstandingController::class, 'download'])->name('sales-outstanding.download');
            
            Route::get('/purchase-tds-report', [PurchaseTDSReportController::class, 'index']);
            Route::match(['get', 'post'], '/purchase-tds-report/preview', [PurchaseTDSReportController::class, 'preview'])->name('purchase-tds-report.preview');
            Route::get('/purchase-tds-report/download/{format}', [PurchaseTDSReportController::class, 'download'])->name('purchase-tds-report.download');
            
            Route::get('/SacSummaryReport', [SacSummaryReportController::class, 'first']);
            // Route::get('/SacSummaryReport/index', [SacSummaryReportController::class, 'index']);
            // Route::get('/SacSummaryReport/create', [SacSummaryReportController::class, 'create']);
            // Route::get('/SacSummaryReport/{id}/edit', [SacSummaryReportController::class, 'edit']);
            
            Route::get('/SalesTDSReport', [SalesTDSReportController::class, 'first']);
            Route::get('/SalesTDSReport/index', [SalesTDSReportController::class, 'index']);
            Route::get('/SalesTDSReport/create', [SalesTDSReportController::class, 'create']);
            Route::get('/SalesTDSReport/{id}/edit', [SalesTDSReportController::class, 'edit']);
            
            Route::get('/DSRReport', [DSRReportController::class, 'first']);
            // Route::get('/DSRReport/index', [DSRReportController::class, 'index']);
            // Route::get('/DSRReport/create', [DSRReportController::class, 'create']);
            // Route::get('/DSRReport/{id}/edit', [DSRReportController::class, 'edit']);
            
            Route::get('/PurchaseOutstanding', [PurchaseOutstandingController::class, 'first']);
            Route::get('/PurchaseOutstanding/index', [PurchaseOutstandingController::class, 'index']);
            Route::get('/PurchaseOutstanding/create', [PurchaseOutstandingController::class, 'create']);
            Route::get('/PurchaseOutstanding/{id}/edit', [PurchaseOutstandingController::class, 'edit']);
            
            Route::get('/SallesRegister', [SallesRegisterController::class, 'first']);
            Route::get('/SallesRegister/index', [SallesRegisterController::class, 'index']);
            Route::get('/SallesRegister/create', [SallesRegisterController::class, 'create']);
            Route::get('/SallesRegister/{id}/edit', [SallesRegisterController::class, 'edit']);
            
            Route::get('/GstPayableReport', [GstPayableReportController::class, 'first']);
            Route::get('/GstPayableReport/index', [GstPayableReportController::class, 'index']);
            Route::get('/GstPayableReport/create', [GstPayableReportController::class, 'create']);
            Route::get('/GstPayableReport/{id}/edit', [GstPayableReportController::class, 'edit']);
            
            Route::get('/PurchaseRegister', [PurchaseRegisterController::class, 'first']);
            Route::get('/PurchaseRegister/index', [PurchaseRegisterController::class, 'index']);
            Route::get('/PurchaseRegister/create', [PurchaseRegisterController::class, 'create']);
            Route::get('/PurchaseRegister/{id}/edit', [PurchaseRegisterController::class, 'edit']);
            
            Route::get('/ProductivityReport', [ProductivityReportController::class, 'first']);
            // Route::get('/ProductivityReport/index', [ProductivityReportController::class, 'index']);
            // Route::get('/ProductivityReport/create', [ProductivityReportController::class, 'create']);
            // Route::get('/ProductivityReport/{id}/edit', [ProductivityReportController::class, 'edit']);
            
            Route::get('/DeliveryAdviceReport', [DeliveryAdviceReportController::class, 'first']);
            Route::get('/DeliveryAdviceReport/index', [DeliveryAdviceReportController::class, 'index']);
            Route::get('/DeliveryAdviceReport/create', [DeliveryAdviceReportController::class, 'create']);
            Route::get('/DeliveryAdviceReport/{id}/edit', [DeliveryAdviceReportController::class, 'edit']);

            Route::get('/receipt-ledger', [ReceiptLedgerController::class, 'index']);
            Route::match(['get', 'post'], '/receipt-ledger/preview', [ReceiptLedgerController::class, 'preview'])->name('receipt-ledger.preview');
            Route::get('/receipt-ledger/download/{format}', [ReceiptLedgerController::class, 'download'])->name('receipt-ledger.download');
            
            Route::get('/purchase-ledger', [PurchaseLedgerController::class, 'index']);
            Route::match(['get', 'post'], '/purchase-ledger/preview', [PurchaseLedgerController::class, 'preview'])->name('purchase-ledger.preview');
            Route::get('/purchase-ledger/download/{format}', [PurchaseLedgerController::class, 'download'])->name('purchase-ledger.download');
            
            Route::get('/Sales', [SalesController::class, 'first']);
            // Route::get('/Sales/index', [SalesController::class, 'index']);
            // Route::get('/Sales/create', [SalesController::class, 'create']);
            // Route::get('/Sales/{id}/edit', [SalesController::class, 'edit']);
            
            Route::get('/Purchase', [PurchaseController::class, 'first']);
            // Route::get('/Purchase/index', [PurchaseController::class, 'index']);
            // Route::get('/Purchase/create', [PurchaseController::class, 'create']);
            // Route::get('/Purchase/{id}/edit', [PurchaseController::class, 'edit']);
        });

    });

    //(5) member routes
    Route::middleware(['permission:members'])->group(function(){
        Route::prefix('admin')->group(function(){
            Route::resource('users', MemberUserController::class);
            
            Route::get('/user-role', [MembersUserRoleController::class, 'index']);
            Route::get('/user-role/create', [MembersUserRoleController::class, 'create']);
            Route::post('/user-role/store', [MembersUserRoleController::class, 'store'])->name('user-role.store');
            Route::get('/user-role/{id}/edit', [MembersUserRoleController::class, 'edit']);
            Route::put('/user-role/{id}', [MembersUserRoleController::class, 'update'])->name('user-role.update');
            Route::delete('/user-role/{id}', [MembersUserRoleController::class, 'destroy'])->name('user-role.delete');
        });        
    });

    // (6) company setting routes
    Route::middleware(['permission:company-settings'])->group(function(){
        Route::prefix('admin')->group(function(){
            Route::get('company-settings', [CompanySettingController::class, 'edit'])->name('company-settings.edit');
            Route::put('company-settings/{id}', [CompanySettingController::class, 'update'])->name('company-settings.update');
            Route::resource('branches', CompanyBranchController::class);            
        });  
    });
        
});

require __DIR__.'/auth.php';
