<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
// Super Admin
use App\Http\Controllers\W3crmAdminController;
// Admin
use App\Http\Controllers\AdminMain\EnquiryController;
use App\Http\Controllers\AdminMain\PurchaseController;
use App\Http\Controllers\AdminMain\SalesController;
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

use App\Http\Controllers\AdminMain\SallesRegisterController;
use App\Http\Controllers\AdminMain\Vessels\VesselController;
use App\Http\Controllers\SuperAdminMain\CompaniesController;
use App\Http\Controllers\AdminMain\MasterContainerController;
use App\Http\Controllers\AdminMain\MembersUserRoleController;
use App\Http\Controllers\AdminMain\MembersPartyVerificationController;
use App\Http\Controllers\AdminMain\GstPayableReportController;
use App\Http\Controllers\AdminMain\PurchaseRegisterController;
use App\Http\Controllers\AdminMain\SacSummaryReportController;
use App\Http\Controllers\AdminMain\MasterExportPartyController;
use App\Http\Controllers\AdminMain\MasterImportPartyController;
use App\Http\Controllers\AdminMain\MasterPurchaseController;
use App\Http\Controllers\AdminMain\MasterForwarderController;
use App\Http\Controllers\SuperAdminMain\FrontSettingController;
use App\Http\Controllers\AdminMain\Operations\BookingController;
use App\Http\Controllers\AdminMain\ProductivityReportController;
use App\Http\Controllers\AdminMain\MasterContainerSizeController;
use App\Http\Controllers\AdminMain\DeliveryAdviceReportController;
use App\Http\Controllers\AdminMain\TotalSales\TotalSalesByPersonController;

// New Controller Path

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\AdminMain\NotificationController;

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
use App\Http\Controllers\AdminMain\Accounts\TaxInvoiceController;
use App\Http\Controllers\AdminMain\Accounts\OnAccountController;
use App\Http\Controllers\AdminMain\Accounts\PurchaseInvoiceController;
use App\Http\Controllers\AdminMain\Accounts\ProformaInvoiceController;
use App\Http\Controllers\AdminMain\Accounts\PaymentAmountController;
use App\Http\Controllers\AdminMain\Accounts\FileUploadController;

use App\Http\Controllers\AdminMain\Reports\LoadingListController;
use App\Http\Controllers\AdminMain\Reports\ReceiptReportController;
use App\Http\Controllers\AdminMain\Reports\PurchaseReportController;
use App\Http\Controllers\AdminMain\Reports\SalesOutstandingController;
use App\Http\Controllers\AdminMain\Reports\PurchaseTDSReportController;
use App\Http\Controllers\AdminMain\Reports\SalesPurchaseReportController;
use App\Http\Controllers\AdminMain\Reports\PurchaseLedgerController;
use App\Http\Controllers\AdminMain\Reports\ReceiptLedgerController;
use App\Http\Controllers\AdminMain\Reports\CostSheetReportController;
use App\Http\Controllers\AdminMain\Reports\DsrRepostController;
use App\Http\Controllers\AdminMain\Reports\SalesTDSReportController;
use App\Http\Controllers\AdminMain\Reports\PurchaseOutstandingController;

use App\Http\Controllers\AdminMain\JobCard\JobCardController;

// PUBLIC ROUTES (Login, Register, Forgot Password)
Route::controller(W3crmAdminController::class)->group(function () {
    Route::get('/', 'page_login')->name('login');
    // Route::get('register', 'page_register');
    Route::get('page-forgot-password', 'page_forgot_password');
    Route::post('/admin/login', 'login')->name('admin.login');
});
Route::get('register', [W3crmAdminController::class, 'register'])->name('register');
Route::post('admin/register', [W3crmAdminController::class, 'store'])->name('admin.storeRegister');

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
    Route::get('/pending-jobs', [W3crmAdminController::class, 'getPendingJobs'])->name('dashboard.pendingJobs');
    Route::get('/close-jobs', [W3crmAdminController::class, 'getCloseJobs'])->name('dashboard.closeJobs');
    Route::get('/dashboard/leo-pending', [W3crmAdminController::class, 'leoPending'])->name('dashboard.leoPending');
    Route::get('/dashboard/complate-operation', [W3crmAdminController::class, 'complateOperation'])->name('dashboard.complateOperation');
    Route::post('/dashboard/close-job/{id}', [W3crmAdminController::class, 'closeJob'])->name('dashboard.closeJob');

    // routes/web.php
    Route::get('/dashboard/chart-data/{period}', [W3crmAdminController::class, 'getChartData'])->name('dashboard.chartData');
    Route::get('/dashboard/month-wise/chart-data/{period}', [W3crmAdminController::class, 'getMonthWiseChartData'])->name('dashboard.monthWise.chartData');


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

    // Profile
    Route::get('/profile-edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile-destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // (1) Master routes
    Route::middleware(['permission:masters'])->group(function(){

        Route::prefix('admin')->group(function () {

            Route::resource('vessels', VesselController::class);
            Route::resource('ports', MasterPortController::class);
            Route::resource('shippings', MasterShippingController::class);
            Route::resource('voyages', MasterVoyageController::class);
            Route::resource('packages', MasterPackageController::class);
            Route::resource('import-parties', MasterImportPartyController::class);
            Route::resource('purchase-parties', MasterPurchaseController::class);
            Route::resource('forwarders', MasterForwarderController::class);
            Route::resource('export-parties', MasterExportPartyController::class);
            Route::resource('charges', MasterChargeController::class);
            Route::resource('containers', MasterContainerController::class);
            Route::resource('container-sizes', MasterContainerSizeController::class);
            Route::resource('bl-types', MasterBlTypeController::class);
            Route::resource('banks', MasterBankController::class);

            Route::delete('shipper-document/delete/{id}/{name}', [MasterExportPartyController::class, 'deleteDocument'])->name('shipper.document.delete');
            Route::delete('other-document/delete/{id}/{name}', [MasterImportPartyController::class, 'deleteDocument'])->name('other.document.delete');

        });
    });

   // (2) opreration routes

    // Common Model Forms  Route
    Route::post('add-vessel', [CommonFormsController::class, 'CommonVesselForms'])->name('new-vessels.store');
    Route::post('add-party', [CommonFormsController::class, 'CommonPartyForms'])->name('new-party.store');
    Route::put('add-party-edit', [CommonFormsController::class, 'CommonPartyFormsEdit'])->name('new-party.update');
    Route::post('add-forwarder', [CommonFormsController::class, 'forwarderForms'])->name('forwarder.store');
    Route::post('add-port', [CommonFormsController::class, 'CommonPortForms'])->name('new-port.store');
    Route::post('add-package', [CommonFormsController::class, 'CommonPackageForms'])->name('new-package.store');
    Route::post('add-shipping-line', [CommonFormsController::class, 'CommonShippingLine'])->name('new-shipping-line.store');
    Route::post('/get-job-details', [CommonFormsController::class, 'getJobDetails']);
    Route::post('add-bl-type', [CommonFormsController::class, 'addBiType'])->name('bltype.store');
    Route::post('/salesperson/store', [CommonFormsController::class, 'addSalesPerson'])->name('salesperson.store');
    Route::post('/charges-name/store', [CommonFormsController::class, 'addChargesName'])->name('addChargesName.store');
    Route::post('/new-billing-party', [CommonFormsController::class, 'newBillingParty'])->name('new-billing-party.store');
    Route::post('/new-purchase-party', [CommonFormsController::class, 'newPurchaseParty'])->name('new-purchase-party.store');

    Route::POST('multi-file-upload', [CommanMultiFilesUploadController::class, 'updateFileUpload'])->name('multi-file-upload.updateFileUpload');
    Route::post('multi-file-upload/search-file', [CommanMultiFilesUploadController::class, 'searchFile'])->name('multi-file-upload.searchFile');
    Route::get('multi-file-upload/download/{id}', [CommanMultiFilesUploadController::class, 'downloadFile'])->name('multi-file-upload.downloadFile');
    Route::delete('multi-file-upload/{id}', [CommanMultiFilesUploadController::class, 'destroy'])->name('multi-file-upload.delete');
    // Route::get('multi-file-upload/files-for-job/{job}/{fileRelated}', [CommanMultiFilesUploadController::class, 'filesForJob']);

    // bookings related routes
    Route::POST('bookings.add-container', [BookingController::class, 'addContainer'])->name('bookings.addContainer');
    Route::POST('bookings.file-upload', [BookingController::class, 'fileUpload'])->name('bookings.fileUpload');
    Route::post('/bookings/search-file', [BookingController::class, 'searchFile'])->name('bookings.searchFile');
    Route::get('bookings/download/{id}', [BookingController::class, 'downloadFile'])->name('bookings.downloadFile');
    Route::put('bookings/update-container/{id}', [BookingController::class, 'updateContainer'])->name('bookings.updateContainer');
    Route::get('/booking/print/{id}', [BookingController::class, 'print'])->name('booking.print');
    Route::POST('file-upload', [BookingController::class, 'updateFileUpload'])->name('file-upload.uploadFileUpload');
    Route::post('bookings/save-containers', [BookingController::class, 'saveContainers'])->name('bookings.saveContainers');

    Route::post('/container/save', [BookingController::class, 'saveContainer'])->name('container.save');

    Route::get('/container/{id}', [BookingController::class, 'getContainer']);
    Route::delete('/container/{id}', [BookingController::class, 'deleteContainer']);

    Route::get('/container-list/{booking_id}', [BookingController::class, 'listContainers'])->name('container.list');

    // Job Master
    Route::post('/new-party-store', [JobMasterController::class, 'storeNewPartyAjax'])->name('job-master.new-party.store');
    Route::get('/job-master/get-enquiry-details/{id}', [JobMasterController::class, 'getEnquiryDetails'])->name('job-master.get-enquiry-details');


    // Air Import related routes
    Route::put('air-imports/updateHawb', [AirImportController::class, 'updateHawb'])->name('air-imports.updateHawb');
    Route::put('air-imports/updateother', [AirImportController::class, 'updateother'])->name('air-imports.updateother');
    Route::get('air-imports/bl-draft/{id}', [AirImportController::class, 'awbDraftOption'])->name('awb.draft.import.option');
    Route::get('air-imports/hawb-bl-draft/{id}', [AirImportController::class, 'hawbDraftOptionAirImp'])->name('hawb.draft.import.option');
    Route::post('air-imports/bl-draft/generate/{id}', [AirImportController::class, 'generateDraft'])->name('awb.draft.generate.import');
    Route::post('air-imports/hawb-bl-draft/generate/{id}', [AirImportController::class, 'hawbGenerateDraft'])->name('hawb.draft.generate.import');
    Route::post('/air-imports/gross-weight-total', [AirImportController::class, 'chargableWeightTotal'])->name('air-imports.chargableWeightTotal');
    // Route::post('/air-import/check-download',[AirImportController::class, 'checkDownloadPermission'])->name('air.import.check.download');
    Route::post('/air-import/mawb/check-download',[AirImportController::class, 'checkMawbDownloadPermission'])->name('air.import.mawb.check.download');
    Route::post('/air-import/mawb/confirm-download',[AirImportController::class, 'confirmMawbDownload'])->name('air.import.mawb.confirm.download');
    Route::post('/air-import/hawb/confirm-download', [AirImportController::class, 'confirmHawbDownload'])->name('air.import.hawb.confirm.download');
    Route::post('/air-import/hawb/check-download',[AirImportController::class, 'checkHawbDownloadPermission'])->name('air.import.hawb.check.download');

    // Air Export
    Route::get('get-jobmaster-party-details', [AirExportController::class, 'jobMasterPartyNameJobNumberWise']);
    Route::get('air-exports/bl-draft/{id}', [AirExportController::class, 'awbDraftOption'])->name('awb.draft.option');
    Route::get('air-exports/hawb-bl-draft/{id}', [AirExportController::class, 'hawbDraftOption'])->name('hawb.draft.option');
    Route::post('air-export/bl-draft/generate/{id}', [AirExportController::class, 'generateDraft'])->name('awb.draft.generate');
    Route::post('air-export/hawb-bl-draft/generate/{id}', [AirExportController::class, 'hawbGenerateDraft'])->name('hawb.draft.generate');
    Route::post('/air-export/awb-draft/pdf/{id}', [AirExportController::class, 'downloadDraftPdf'])->name('airExport.awb.draft.pdf');
    Route::post('/air-exports/gross-weight-total', [AirExportController::class, 'chargableWeightTotal'])->name('air-exports.chargableWeightTotal');
    // air export restrictions
    Route::post('/air-export/mawb/check-download',[AirExportController::class, 'checkMawbDownloadPermission'])->name('air.export.mawb.check.download');
    Route::post('/air-export/mawb/confirm-download',[AirExportController::class, 'confirmMawbDownload'])->name('air.export.mawb.confirm.download');
    Route::post('/air-export/hawb/check-download',[AirExportController::class, 'checkHawbDownloadPermission'])->name('air.export.hawb.check.download');
    Route::post('/air-export/confirm-hawb-download',[AirExportController::class,'confirmHawbDownload'])->name('air.export.hawb.confirm.download');

    // Sea Import related routes
    Route::post('sea-imports/add-container', [SeaImportController::class, 'addContainer'])->name('sea-imports.addContainer');
    Route::put('sea-imports/update-container/{id}', [SeaImportController::class, 'updateContainer'])->name('sea-imports.updateContainer');
    Route::get('sea-imports/cargo-arrival/{id}', [SeaImportController::class, 'cargoArrivelDetails'])->name('bl.sea-imports.cargoArrivelDetails'); // mourya
    Route::get('sea-imports/freight-certificate/{id}', [SeaImportController::class, 'freightCertificateDetails'])->name('bl.sea-imports.freightCertificateDetails'); // mourya
    Route::get('sea-imports/export-cargo-arrival/{id}', [SeaImportController::class, 'cargoArrivelDetailsExport'])->name('bl.cargoArrivalDetails-seaImp'); // mourya
    Route::get('sea-imports/export-freight-certificate/{id}', [SeaImportController::class, 'freightCertificateExport'])->name('bl.freightCertificateExport-seaImp'); // mourya
    Route::get('/sea-import/sea-way-bill/{id}', [SeaImportController::class, 'showSeaWayBill'])->name('import.sea.way.bill'); // mourya
    Route::get('sea-imports/bl-draft/{id}', [SeaImportController::class, 'blDraftOption'])->name('bl.draft.option.import');
    Route::post('sea-imports/bl-draft/generate/{id}', [SeaImportController::class, 'generateDraft'])->name('import.draft.generate');
    Route::get('sea-imports/getContainerDetail/{id}', [SeaImportController::class, 'getContainerDetail'])->name('getContainerDetail');
    Route::delete('sea-imports/delete-container/{id}', [SeaImportController::class, 'deleteContainer'])->name('sea-imports.deleteContainer');
    Route::post('/sea-imports/gross-weight-total', [SeaImportController::class, 'grossWeightTotal'])->name('sea-imports.grossWeightTotal');
    //export restrictions
    Route::post('/sea-import/check-download',[SeaImportController::class,'checkSeaImportBlPermission'])->name('sea.import.check.download');
    Route::post('/sea-import/confirm-download',[SeaImportController::class,'confirmSeaImportBlDownload'])->name('sea.import.confirm.download');


    // Sea Export related routes
    Route::post('sea-exports/add-container', [SeaExportController::class, 'addContainer'])->name('sea-exports.addContainer');
    Route::put('sea-exports/update-container/{id}', [SeaExportController::class, 'updateContainer'])->name('sea-exports.updateContainer');
    Route::get('sea-exports/bl-draft/{id}', [SeaExportController::class, 'blDraftOption'])->name('bl.draft.option');
    Route::post('/sea-exports/gross-weight-total', [SeaExportController::class, 'grossWeightTotal'])->name('sea-exports.grossWeightTotal');

    Route::post('/sea-exports/add-shipment-line', [SeaExportController::class,'addShipmentLine'])->name('sea-exports.addShipmentLine');
    Route::put('sea-exports/update-shipment/{id}', [SeaExportController::class, 'updateShipmentLine'])->name('sea-exports.updateShipmentLine');
    Route::get('sea-exports/getShipmentDetail/{id}', [SeaExportController::class, 'getShipmentDetail'])->name('getShipmentDetail');
    Route::delete('sea-exports/delete-shipment/{id}', [SeaExportController::class, 'deleteShipmentLine'])->name('sea-exports.deleteShipmentLine');

    Route::get('/sea-export/sea-way-bill/{id}', [SeaExportController::class, 'showSeaWayBill'])->name('sea.way.bill');
    Route::post('/sea-export/bl-draft/generate/{id}', [SeaExportController::class, 'generateDraft'])->name('draft.generate');
    Route::get('/sea-way-bill-docx/{id}', [SeaExportController::class, 'downloadSeaWayBillDocx'])->name('sea.way.bill.docx');

    Route::get('sea-exports/loading-confirmation/{id}', [SeaExportController::class, 'loadingConfirmation'])
        ->name('bl.loadingConfirmation-seaExp');
    Route::get('sea-exports/export-loading-confirmation/{id}', [SeaExportController::class, 'exportLoadingConfirmation'])
        ->name('bl.exportLoadingConfirmation-seaExp');
    Route::get('sea-exports/getContainerDetail/{id}', [SeaExportController::class, 'getContainerDetail'])->name('getContainerDetail');
    Route::delete('sea-exports/delete-container/{id}', [SeaExportController::class, 'deleteContainer'])->name('sea-exports.deleteContainer');
    // export restrictions
    Route::post('/sea-export/check-download',[SeaExportController::class, 'checkSeaExportDownloadPermission'])->name('sea.export.check.download');
    Route::post('/sea-export/confirm-download',[SeaExportController::class, 'confirmSeaExportDownload'])->name('sea.export.confirm.download');

    // transport related routes
    Route::post('transports.add-container', [TransportController::class, 'addContainer'])->name('transports.addContainer');
    // Route::put('transports.update-container/{id}', [TransportController::class, 'updateContainer'])->name('transports.updateContainer');
    Route::post('/transport/container/save', [TransportController::class, 'saveContainer'])
        ->name('transports.saveContainer');

    Route::get('/transport/container/{id}', [TransportController::class, 'getContainer'])
        ->name('transports.getContainer');

    Route::delete('/transport/container/{id}', [TransportController::class, 'deleteContainer'])
        ->name('transports.deleteContainer');

    // Sea Import Data Entry related routes
    Route::post('sea-import-data-entry/add-container', [SeaImportDataEntryController::class, 'addContainer'])->name('sea-import-data-entry.addContainer');
    Route::put('sea-import-data-entry/update-container/{id}', [SeaImportDataEntryController::class, 'updateContainer'])->name('sea-import-data-entry.updateContainer');

    //Job Open Close Route
    Route::post('/job-open-close/filter', [JobOpenCloseController::class, 'filter'])->name('job-open-close.filter');
    Route::post('/job-open-close/bulk-update', [JobOpenCloseController::class, 'bulkUpdate'])->name('job-open-close.bulkUpdate');
    Route::post('/job-open-close/fetch', [JobOpenCloseController::class, 'fetchData'])
    ->name('job-open-close.fetch');
    Route::get('/job-status/notification/read/{id}', [NotificationController::class, 'markAsReadJobStatus'])->name('jobStatus.notification.read');
    Route::get('/notification/all', [NotificationController::class, 'all'])->name('admin.notification.all');


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

            Route::resource('/Enquiry', EnquiryController::class);
            Route::get('/Enquiry', [EnquiryController::class, 'index']);
            Route::get('/Enquiry/create', [EnquiryController::class, 'create']);

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

            Route::resource('proforma-invoices', ProformaInvoiceController::class);
            Route::get('/dsr-report', [DsrRepostController::class, 'index']);
            Route::match(['get', 'post'], '/dsr-report/preview', [DsrRepostController::class, 'preview'])->name('dsr-report.preview');
            Route::get('/dsr-report/download/{format}', [DsrRepostController::class, 'download'])->name('dsr-report.download');
            Route::get('/dsr-report/download-excel', [DsrRepostController::class, 'downloadExcel'])
            ->name('dsr.download.excel');

            // purchase
            Route::resource('purchase-invoices', PurchaseInvoiceController::class);
        });
    });

    // (3) Account routes

    // Sales Invoice routes
    Route::post('sales-invoices/job-numbers', [SalesInvoiceController::class, 'getJobNo'])->name('sales-invoices.getJobNo');
    Route::post('sales-invoices/invoice-record', [SalesInvoiceController::class, 'getInvoiceRecord'])->name('sales-invoices.getInvoiceRecord');
    Route::post('sales-invoices/charge-details', [SalesInvoiceController::class, 'getCharge'])->name('sales-invoices.getCharge');
    Route::post('sales-invoices/charges', [SalesInvoiceController::class, 'salesInvoiceCharge'] )->name('sales-invoices.salesInvoiceCharge');
    Route::post('sales-invoices-cont/charges', [SalesInvoiceController::class, 'salesInvoiceChargeContainer'] )->name('sales-invoices.salesInvoiceChargeContainer');
    Route::put('sales-invoices/charges/{id}', [SalesInvoiceController::class, 'UpdateSalesInvoiceCharge'] )->name('sales-invoices.UpdateSalesInvoiceCharge');
    Route::get('sales-invoices/import/{id}', [SalesInvoiceController::class, 'ImportSalesInvoice'] )->name('salesInvoice.import');
    Route::get('/sales-invoices/get-charge-details/{charge_id}/{invoice_id}', [SalesInvoiceController::class, 'getChargeDetails'])
    ->name('sales-invoices.getChargeDetails');
    Route::get('sales-invoices/print/{id}', [SalesInvoiceController::class, 'printSalesInvoice'] )->name('salesInvoice.printSalesInvoice');
    Route::get('/sales-invoices/getChargeDetail/{id}', [SalesInvoiceController::class, 'getChargeDetailForUpdate'])->name('sales-invoices.getChargeDetail');
    Route::delete('/sales-invoices/delete-charge/{id}', [SalesInvoiceController::class, 'deleteChargeDetail'])
    ->name('sales-invoices.deleteChargeDetail');

    // common sales files
    Route::POST('account/file-upload', [CommanMultiFilesUploadController::class, 'accountUpdateFileUpload'])->name('account.file-upload.uploadFileUpload');

    // Enquiry
    Route::post('enquiry/charge-details', [EnquiryController::class, 'getCharge'])->name('enquiry.getCharge');
    Route::post('admin/enquiry/store', [EnquiryController::class, 'store'])->name('enquiry.store');
    Route::post('admin/enquiry/selling-update', [EnquiryController::class, 'sellingUpdate'])->name('enquiry.selling.update');
    Route::post('admin/enquiry/buy-update', [EnquiryController::class, 'buyUpdate'])->name('enquiry.buy.update');
    Route::post('admin/enquiry/cbm-update', [EnquiryController::class, 'cbmUpdate'])->name('enquiry.cbm.update');
    Route::delete('admin/enquiry/delete/{id}', [EnquiryController::class, 'destroy'])->name('enquiry.destroy');
    Route::get('admin/Enquiry/{id}/edit', [EnquiryController::class, 'edit'])->name('enquiry.edit');

    // Purchase Invoice routes
    Route::post('purchase-invoices/job-numbers', [PurchaseInvoiceController::class, 'getJobNo'])->name('purchase-invoices.getJobNo');
    Route::post('purchase-invoices/invoice-record', [PurchaseInvoiceController::class, 'getInvoiceRecord'])->name('purchase-invoices.getInvoiceRecord');
    Route::post('purchase-invoices/charges', [PurchaseInvoiceController::class, 'purchaseInvoiceCharge'] )->name('purchase-invoices.purchaseInvoiceCharge');
    Route::put('purchase-invoices/charges/{id}', [PurchaseInvoiceController::class, 'UpdatePurchaseInvoiceCharge'] )->name('purchase-invoices.UpdatePurchaseInvoiceCharge');
    Route::get('purchase-invoices/get-charge-details/{charge_id}/{invoice_id}', [PurchaseInvoiceController::class, 'getChargeDetails'])->name('purchase-invoices.getChargeDetails');
    Route::get('purchase-invoices/import/{id}', [PurchaseInvoiceController::class, 'ImportPurchaseInvoice'] )->name('ImportPurchaseInvoice.import');
    Route::get('purchase-invoices/print/{id}', [PurchaseInvoiceController::class, 'printPurchaseInvoice'] )->name('purchaseInvoice.printPurchaseInvoice');

    Route::get('/purchase-invoices/getChargeDetail/{id}', [PurchaseInvoiceController::class, 'getChargeDetailForUpdate'])->name('purchase-invoices.getChargeDetail');
    Route::delete('/purchase-invoices/delete-charge/{id}', [PurchaseInvoiceController::class, 'deleteChargeDetail'])
    ->name('purchase-invoices.deleteChargeDetail');


    // Proforma Invoice routes
    Route::post('proforma-invoices/job-numbers', [ProformaInvoiceController::class, 'getJobNo'])->name('proforma-invoices.getJobNo');
    Route::post('proforma-invoices/invoice-record', [ProformaInvoiceController::class, 'getInvoiceRecord'])->name('proforma-invoices.getInvoiceRecord');
    Route::post('proforma-invoices/charges', [ProformaInvoiceController::class, 'proformaInvoiceCharge'] )->name('proforma-invoices.proformaInvoiceCharge');
    Route::put('proforma-invoices/charges/{id}', [ProformaInvoiceController::class, 'UpdateProformaInvoiceCharge'] )->name('proforma-invoices.UpdateProformaInvoiceCharge');
    Route::get('proforma-invoices/get-charge-details/{charge_id}/{invoice_id}', [ProformaInvoiceController::class, 'getChargeDetails'])->name('proforma-invoices.getChargeDetails');
    Route::post('proforma-invoices/charge-details', [ProformaInvoiceController::class, 'getCharge'])->name('proforma-invoices.getCharge');
    Route::get('proforma-invoices/import/{id}', [ProformaInvoiceController::class, 'importProformaInvoice'] )->name('ImportProformaInvoice.import');
    Route::get('/proforma-invoices/getChargeDetail/{id}', [ProformaInvoiceController::class, 'getChargeDetailForUpdate'])->name('proforma-invoices.getChargeDetail');
    Route::delete('/proforma-invoices/delete-charge/{id}', [ProformaInvoiceController::class, 'deleteChargeDetail'])->name('proforma-invoices.deleteChargeDetail');
    Route::get('proforma-invoices/print/{id}', [ProformaInvoiceController::class, 'printProformaInvoice'] )->name('proformaInvoice.printProformaInvoice');

    // Tax Invoice routes
    Route::post('tax-invoices/job-numbers', [TaxInvoiceController::class, 'getJobNo'])->name('tax-invoices.getJobNo');
    Route::get('get-tax-invoices', [TaxInvoiceController::class, 'getTaxInvoice'])->name('tax-invoices.getTaxInvoice');
    Route::get('tax-invoices-error', [TaxInvoiceController::class, 'showErrorPage'])->name('tax-invoices.showErrorPage');

    // receipts routes
    Route::match(['post','put'], 'receipts-payment-details/{id}', [ReceiptController::class, 'paymentDetails'] )->name('receipts.paymentDetails');

    // Purchase Paymen Route
    Route::match(['post','put'], 'purchase-payment-details/{id}', [PurchasePaymentController::class, 'paymentDetails'] )->name('purchase-payment.paymentDetails');

    Route::middleware(['permission:accounts'])->group(function(){
        Route::prefix('admin')->group(function(){
            Route::resource('sales-invoices', SalesInvoiceController::class);
            Route::resource('tax-invoices', TaxInvoiceController::class);

            Route::resource('receipts', ReceiptController::class);
            Route::resource('purchase-payment', PurchasePaymentController::class);
            Route::resource('on-accounts', OnAccountController::class);
            Route::resource('payment-amount', PaymentAmountController::class);

            Route::post('file-upload', [FileUploadController::class, 'updateFileUpload'])->name('file-upload.updateFileUpload');
            Route::post('file-upload/search-file', [FileUploadController::class, 'searchFile'])->name('file-upload.searchFile');
            Route::get('download/{id}', [FileUploadController::class, 'downloadFile'])->name('file-upload.downloadFile');
            Route::delete('file-upload/{id}', [FileUploadController::class, 'destroy'])->name('file-upload.destroy');
        });
    });

    //(4) Report routes
    Route::middleware(['permission:reports'])->group(function () {
        Route::prefix('admin')->group(function(){

            Route::get('/sales-report', [SalesTDSReportController::class, 'index']);
            Route::match(['get', 'post'], '/sales-tds-report/preview', [SalesTDSReportController::class, 'preview'])->name('sales-tds-report.preview');
            Route::get('/sales-report/download/{format}', [SalesTDSReportController::class, 'download'])->name('sales-tds-report.download');

            Route::get('/purchase-report', [PurchaseTDSReportController::class, 'index']);
            Route::match(['get', 'post'], '/purchase-tds-report/preview', [PurchaseTDSReportController::class, 'preview'])->name('purchase-tds-report.preview');
            Route::get('/purchase-report/download/{format}', [PurchaseTDSReportController::class, 'download'])->name('purchase-tds-report.download');

            Route::get('/sale-purchase-report', [SalesPurchaseReportController::class, 'index']);
            Route::match(['get', 'post'], '/sale-purchase-report/preview', [SalesPurchaseReportController::class, 'preview'])
                ->name('sale-purchase-report.preview');
            Route::get('/sale-purchase-report/download/{format}', [SalesPurchaseReportController::class, 'download'])
                ->name('sale-purchase-report.download');

            Route::get('/sales-outstanding', [SalesOutstandingController::class, 'index']);
            Route::match(['get', 'post'], '/sales-outstanding/preview', [SalesOutstandingController::class, 'preview'])->name('sales-outstanding.preview');
            Route::get('/sales-outstanding/download/{format}/{id}', [SalesOutstandingController::class, 'download'])->name('sales-outstanding.download');

            Route::get('/purchase-outstanding', [PurchaseOutstandingController::class, 'index']);
            Route::match(['get', 'post'], '/purchase-outstanding/preview', [PurchaseOutstandingController::class, 'preview'])->name('purchase-outstanding.preview');
            Route::get('/purchase-outstanding/download/{format}/{id}', [PurchaseOutstandingController::class, 'download'])->name('purchase-outstanding.download');

            Route::get('/loading-list', [LoadingListController::class, 'index']);
            Route::post('/loading-list/preview', [LoadingListController::class, 'preview'])->name('loading-list.preview');
            Route::get('/loading-list/download/{format}', [LoadingListController::class, 'download'])->name('loading-list.download');

            Route::get('/cost-sheet-report', [CostSheetReportController::class, 'index']);
            Route::match(['get', 'post'], '/cost-sheet-report/preview', [CostSheetReportController::class, 'preview'])->name('cost-sheet-report.preview');
            // Route::get('/cost-sheet-report/download/{format}', [CostSheetReportController::class, 'download'])->name('cost-sheet-report.download');


            //Receipt report
            Route::get('/receipts-list', [ReceiptReportController::class, 'listReceipt']);
            Route::post('/receipt-list/preview', [ReceiptReportController::class, 'preview'])->name('receipt-list.preview');
            Route::get('/receipt-list/download/{format}', [ReceiptReportController::class, 'download'])->name('receipt-list.download');

            // Purchase Payment Report
            Route::get('/purchase-payment-list', [PurchaseReportController::class, 'listpurhcasePayment']);
            Route::post('/purchase-payment-list/preview', [PurchaseReportController::class, 'preview'])->name('purhcasePayment-list.preview');

            Route::get('/SacSummaryReport', [SacSummaryReportController::class, 'first']);
            // Route::get('/SacSummaryReport/index', [SacSummaryReportController::class, 'index']);
            // Route::get('/SacSummaryReport/create', [SacSummaryReportController::class, 'create']);
            // Route::get('/SacSummaryReport/{id}/edit', [SacSummaryReportController::class, 'edit']);

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


            Route::get('/shipper-verification-party', [MembersPartyVerificationController::class, 'shipperIndex'])->name('shipper.verification.party');
            Route::post('/shipper-store', [MembersPartyVerificationController::class, 'shipperStore'])->name('party.varification.store');
            Route::get('/other-verification-party', [MembersPartyVerificationController::class, 'otherIndex'])->name('other.verification.party');
            Route::post('/other-party-store', [MembersPartyVerificationController::class, 'otherPartyStore'])->name('other.party.varification.store');

            Route::post('/party-approval-permission/{id}', [MembersPartyVerificationController::class, 'partyApprovalPermission'])->name('party.approval.permission');
            Route::get(
                '/party/document/download/{id}',
                [MembersPartyVerificationController::class, 'downloadPartyDocument']
            )->name('party.document.download');

            Route::get('/all-sales-person', [TotalSalesByPersonController::class, 'listUsers'])->name('salesPerson.listUsers');
            Route::post('/sales-person-report', [TotalSalesByPersonController::class, 'salesPersonReport'])->name('sales.person.report');

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

    // Job-card
    Route::middleware(['permission:job-card'])->group(function(){
        Route::prefix('admin')->group(function(){
            //air
            Route::get('air-job-card', [JobCardController::class, 'airJobCard'])->name('airJobCard');
            Route::post('air-job-card/print', [JobCardController::class, 'printAirJobCard'])->name('airJobCard.print');
            //sea
            Route::get('sea-job-card', [JobCardController::class, 'seaJobCard'])->name('seaJobCard');
            Route::post('sea-job-card/print', [JobCardController::class, 'printSeaJobCard'])->name('seaJobCard.print');

        });
    });

});

require __DIR__.'/auth.php';
