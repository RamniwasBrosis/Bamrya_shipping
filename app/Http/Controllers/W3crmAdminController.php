<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Company;
use App\Models\Operations\OperationAirExport;
use App\Models\Operations\OperationAirImport;
use App\Models\Operations\OperationSeaExport;
use App\Models\Operations\OperationSeaImport;
use App\Models\Operations\OperationJobMaster;
use App\Models\Operations\OperationSeaExportCont;
use App\Models\Operations\OperationSeaImportCont;
use Spatie\Permission\Models\Role;
use App\Models\Accounts\AccountSaleInvoice;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Http\Request;

class W3crmAdminController extends Controller
{
  
    public function dashboard_2()
    {

        $company_id = Auth::user()->company_id;
        
        $currentMonth = date('m');
        $currentYear  = date('Y');
        
        $startDateOfMonth = now()->startOfMonth()->toDateString(); 
        $endDateOfMonth = now()->endOfMonth()->toDateString(); 
    
        $airExport = OperationAirExport::where('company_id', $company_id)
        ->whereMonth('booking_date', $currentMonth)
        ->whereYear('booking_date', $currentYear)
        ->count();
    
        $airImport = OperationAirImport::where('company_id', $company_id)
            ->whereMonth('booking_date', $currentMonth)
            ->whereYear('booking_date', $currentYear)
            ->count();
        
        $seaExport = OperationSeaExport::where('company_id', $company_id)
            ->whereMonth('booking_date', $currentMonth)
            ->whereYear('booking_date', $currentYear)
            ->count();
        
        $seaImport = OperationSeaImport::where('company_id', $company_id)
            ->whereMonth('booking_date', $currentMonth)
            ->whereYear('booking_date', $currentYear)
            ->count();
    
        // ðŸ”¥ Count Pending Leo Date for Export + Import
        $leo_pending = OperationSeaExportCont::where('company_id', $company_id)
                            ->whereNull('leo_date')
                            ->count()
                        +
                        OperationSeaImportCont::where('company_id', $company_id)
                            ->whereNull('out_off_charge_date')
                            ->count()
                        +
                        OperationAirExport::where('company_id', $company_id)
                            ->whereNull('leo_date')
                            ->count()
                        +
                        OperationAirImport::where('company_id', $company_id)
                            ->whereNull('out_off_charge_date')
                            ->count();
        // *** finished *** 
        
        // Complate Operation
        $complate_operation = OperationSeaExportCont::where('company_id', $company_id)
                            ->whereNotNull('sob_date')
                            ->whereNotNull('leo_date')
                            ->count()
                        +
                        OperationSeaImportCont::where('company_id', $company_id)
                            ->whereNotNull('out_off_charge_date')
                            ->whereNotNull('do_date')
                            ->count()
                        +
                        OperationAirExport::where('company_id', $company_id)
                            ->whereNotNull('leo_date')
                            ->count()
                        +
                        OperationAirImport::where('company_id', $company_id)
                            ->whereNotNull('out_off_charge_date')
                            ->whereNotNull('arrival_date')
                            ->count();
        
        // Total jobs
        $startDate = now()->startOfMonth()->toDateString(); // 2025-11-01
        $endDate = now()->endOfMonth()->toDateString();     // 2025-11-30
        
        $totalJobs = DB::table('operation_job_masters')
        ->where('company_id', $company_id)
        ->whereBetween('job_date', [$startDateOfMonth, $endDateOfMonth])
        ->count();
            
        // close jobs
        $closeJobs = OperationJobMaster::where('company_id', $company_id)->whereYear('job_date', Carbon::now()->year)->where('job_status', 'C')->count();
        
        // Pending Jobs
        $pendingJobs = OperationJobMaster::where('company_id', $company_id)
            ->doesntHave('seaExport')
            ->doesntHave('seaImport')
            ->doesntHave('airExport')
            ->doesntHave('airImport')
            ->count();
            
        // *** finished *** 
            
        // Pending Bl 
        $airImports = OperationAirImport::with('jobMaster')
            ->where('company_id', $company_id)
            ->where(function($query) {
                $query->whereNull('eta_date')
                      ->orWhereNull('etd_date')
                      ->orWhereNull('out_off_charge_date')
                      ->orWhereNull('customer_inv_no')
                      ->orWhereNull('arrival_date')
                      ->orWhereNull('bill_of_entry_date')
                      ->orWhereNull('check_list_date');
            })
            ->get();
        $airExports = OperationAirExport::with('jobMaster')
            ->where('company_id', $company_id)
            ->where(function($query) {
                $query->whereNull('eta_date')
                      ->orWhereNull('etd_date')
                      ->orWhereNull('leo_date')
                      ->orWhereNull('check_list_date')
                      ->orWhereNull('sbill_no')
                      ->orWhereNull('customer_inv_no')
                      ->orWhereNull('cartining_date');
            })
            ->get();
        $seaImports = OperationSeaImportCont::with('seaImport.jobMaster')
        ->where('company_id', $company_id)
        ->where(function($q) {
            // out_off_charge_date NULL OR EMPTY
            $q->whereNull('out_off_charge_date')
              ->orWhere('out_off_charge_date', '')
              ->orWhereNull('check_list_date')
              ->orWhereNull('customer_inv_no')
              ->orWhereNull('destuffing_date')
              ->orWhereNull('bill_of_entry_date')
          

              ->orWhereHas('seaImport', function($sub) {
                  $sub->whereNull('eta_date')
                      ->orWhere('eta_date', '')
                      ->orWhere('eta_date', '0000-00-00');
              })
              ->orWhereHas('seaImport', function($sub) {
                  $sub->whereNull('etd_date')
                      ->orWhere('etd_date', '')
                      ->orWhere('etd_date', '0000-00-00');
              });
        })
        ->get();
        $seaExports = OperationSeaExportCont::with('seaExport.jobMaster')
        ->where('company_id', $company_id)
        ->where(function($q) {
            $q->whereNull('leo_date')
              ->orWhere('leo_date', '')
              ->orWhereNull('cartining_date')
              ->orWhereNull('check_list_date')
              ->orWhereNull('customer_inv_no')
              ->orWhereNull('sbill_no')
  
              ->orWhereHas('seaExport', function($sub) {
                  $sub->whereNull('eta_date')
                      ->orWhere('eta_date', '');
              })
              ->orWhereHas('seaExport', function($sub) {
                  $sub->whereNull('etd_date')
                      ->orWhere('etd_date', '');
              });
        })
        ->get();

        $pendingBlLists =$airExports
        ->merge($airExports)
        ->merge($airImports)
        ->merge($seaImports)
        ->merge($seaExports);
        
        // *** finished *** 
    
        // financial years
        $minInvoiceDate = \DB::table('operation_job_masters')->where('company_id', $company_id)->min('job_date'); 
        $startYear = $minInvoiceDate ? \Carbon\Carbon::parse($minInvoiceDate)->year : date('Y');
        
        $minYear = (date('m', strtotime($minInvoiceDate)) >= 4)
                    ? date('Y', strtotime($minInvoiceDate))
                    : date('Y', strtotime($minInvoiceDate)) - 1;
        
        $currentYear = date('m') >= 4 ? date('Y') : date('Y') - 1;
        
        $financialYears = [];
        
        for ($y = $minYear; $y <= $currentYear + 1; $y++) {
            $financialYears[] = $y . '-' . ($y + 1);
        }
        // *** finished *** 
        
        // Pending Bills Month Wise
        $pendingBillsJobs = OperationJobMaster::where('company_id', $company_id)
            ->whereBetween('job_date', [$startDateOfMonth, $endDateOfMonth])
            ->whereNotIn('id', function ($query) use ($company_id) {
                $query->select('job_no')
                    ->from('account_sale_invoices')
                    ->where('company_id', $company_id)
                    ->whereNotNull('job_no');
            })
            ->orderBy('job_date', 'desc')
            ->get();
        // Pending Bills total YEAR Wise
        $pendingBillsFY = OperationJobMaster::with(['shipperName', 'consigneeName'])
            ->where('company_id', $company_id)
            ->whereDate('job_date', '>=', '2026-04-01') // Start from FY 2026-2027
            ->whereNotIn('id', function ($query) use ($company_id) {
                $query->select('job_no')
                    ->from('account_sale_invoices')
                    ->where('company_id', $company_id)
                    ->whereNotNull('job_no');
            })
            ->get()
            ->groupBy(function ($job) {
        
                $date = \Carbon\Carbon::parse($job->job_date);
        
                return $date->month >= 4
                    ? $date->year . '-' . ($date->year + 1)
                    : ($date->year - 1) . '-' . $date->year;
            })
            ->sortKeysDesc();
            
        $pendingBillsCount = $pendingBillsJobs->count();
        $pendingBillsCountTotal = $pendingBillsFY->flatten()->count();

        // previous month's pending bills    
        $previousMonthStart = now()->subMonth()->startOfMonth()->toDateString();
        $previousMonthEnd   = now()->subMonth()->endOfMonth()->toDateString();
        
        $previousMonthPendingBills = OperationJobMaster::where('company_id', $company_id)
            ->whereBetween('job_date', [$previousMonthStart, $previousMonthEnd])
            ->whereNotIn('id', function ($query) use ($company_id) {
                $query->select('job_no')
                    ->from('account_sale_invoices')
                    ->where('company_id', $company_id)
                    ->whereNotNull('job_no');
            })
            ->get();
        $previousMonthPendingBillsCount = $previousMonthPendingBills->count();
        
        // Need To Close Job (FY 2026-27 onwards)
        $needToCloseJobs = OperationJobMaster::with(['shipperName', 'consigneeName'])
            ->where('company_id', $company_id)
            ->whereDate('job_date', '>=', '2026-04-01')
            ->where('job_status', 'O')
        
            // Must exist in Sales Invoice
            ->whereIn('id', function ($query) use ($company_id) {
                $query->select('job_no')
                    ->from('account_sale_invoices')
                    ->where('company_id', $company_id)
                    ->whereNotNull('job_no');
            })
        
            // Must also exist in Purchase Invoice
            ->whereIn('id', function ($query) use ($company_id) {
                $query->select('job_no')
                    ->from('account_purchase_invoices')
                    ->where('company_id', $company_id)
                    ->whereNotNull('job_no');
            })
        
            ->orderBy('job_date', 'desc')
            ->get();
        
        $needToCloseJobsCount = $needToCloseJobs->count();
    
        return view('w3crm.dashboard.index_2', compact(
            'airImport','airExport','seaImport','seaExport','closeJobs', 'totalJobs', 'pendingJobs','leo_pending','pendingBlLists', 'financialYears', 'complate_operation','pendingBillsJobs',
            'pendingBillsCount','pendingBillsFY','pendingBillsCountTotal','previousMonthPendingBills','previousMonthPendingBillsCount','needToCloseJobs','needToCloseJobsCount'
        ));
    }
    
    public function closeJob($id)
    {
        $company_id = Auth::user()->company_id;
    
        $job = OperationJobMaster::where('company_id', $company_id)
            ->findOrFail($id);
    
        $job->job_status = 'C';
        $job->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Job closed successfully.'
        ]);
    }
    
    public function getPendingJobs()
    {
        
        $company_id = Auth::user()->company_id;
        
        $jobs = OperationJobMaster::with(['seaExport','seaImport','airExport','airImport'])
            ->where('company_id', $company_id)
            ->whereIn('job_activity', ['SEAIMP.FWD', 'SEAEXP.FWD', 'AIRIMP.FWD', 'AIREXP.FWD', 'SEAEXP.NVOCC', 'SEAIMP.NVOCC'])
            ->doesntHave('seaExport')
            ->doesntHave('seaImport')
            ->doesntHave('airExport')
            ->doesntHave('airImport')
            ->get();
    
        return view('w3crm.dashboard.pending_jobs', compact('jobs'));
    }
    
    // close job
    public function getCloseJobs()
    {
        $company_id = Auth::user()->company_id;
    
        $today = now();
    
        if ($today->month >= 4) {
            $fyStart = Carbon::create($today->year, 4, 1)->startOfDay();
            $fyEnd   = Carbon::create($today->year + 1, 3, 31)->endOfDay();
        } else {
            $fyStart = Carbon::create($today->year - 1, 4, 1)->startOfDay();
            $fyEnd   = Carbon::create($today->year, 3, 31)->endOfDay();
        }
    
        $jobs = OperationJobMaster::with(['shipperName', 'consigneeName'])
            ->where('company_id', $company_id)
            ->whereBetween('job_date', [$fyStart, $fyEnd])
            ->where('job_status', 'C')
            // ->orderBy('job_date', 'desc')
            ->get();
    
        return view('w3crm.dashboard.close_jobs', compact('jobs'));
    }
    
    // public function getCloseJobs(){
    //     $company_id = Auth::user()->company_id;
        
    //     $jobs = OperationJobMaster::where('company_id', $company_id)
    //         ->where('job_status', 'C')
    //         ->get();
    
    //     return view('w3crm.dashboard.close_jobs', compact('jobs'));
    // }

    // leo date 
    public function leoPending()
    {
        $company_id = Auth::user()->company_id;
    
        $sea_export = OperationSeaExportCont::with('seaExport.jobMaster')
                    ->where('company_id', $company_id)
                    ->whereNull('leo_date')
                    ->get();
    
        $sea_import = OperationSeaImportCont::with('seaImport.jobMaster')
                    ->where('company_id', $company_id)
                    ->whereNull('out_off_charge_date')
                    ->get();
                    
        $air_export = OperationAirExport::with('jobMaster')
                    ->where('company_id', $company_id)
                    ->whereNull('leo_date')
                    ->get();
                    
        $air_import = OperationAirImport::with('jobMaster')
                    ->where('company_id', $company_id)
                    ->whereNull('out_off_charge_date')
                    ->get();
    
        return view('w3crm.dashboard.leo_pending_list', compact('sea_export','sea_import', 'air_export', 'air_import'));
    }
    
    // Operation Complate 
    public function complateOperation()
    {
        $company_id = Auth::user()->company_id;
    
        $sea_export = OperationSeaExportCont::with('seaExport.jobMaster')
                    ->where('company_id', $company_id)
                    ->whereNotNull('leo_date')
                    ->whereNotNull('sob_date')
                    ->get();
    
        $sea_import = OperationSeaImportCont::with('seaImport.jobMaster')
                    ->where('company_id', $company_id)
                    ->whereNotNull('out_off_charge_date')
                    ->whereNotNull('do_date')
                    ->get();
                    
        $air_export = OperationAirExport::with('jobMaster')
                    ->where('company_id', $company_id)
                    ->whereNotNull('leo_date')
                    ->get();
                    
        $air_import = OperationAirImport::with('jobMaster')
                    ->where('company_id', $company_id)
                    ->whereNotNull('out_off_charge_date')
                    ->whereNotNull('arrival_date')
                    ->get();
    
        return view('w3crm.dashboard.complate_operation_list', compact('sea_export','sea_import', 'air_export', 'air_import'));
    }


    public function dashboard()
    {
		$page_title = 'Dashboard';
        $page_description = 'Some description for the page';
		return view('w3crm.dashboard.index', compact('page_title', 'page_description'));
	}

    public function page_login()
    {
        $page_title = 'Login';
        $page_description = 'Some description for the page';
        return view('w3crm.page.login', compact('page_title', 'page_description'));
    }
    
    public function login(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return back()->withErrors(['email' => 'Email not found']);
        }
    
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Incorrect password']);
        }
    
        Auth::login($user); 
    
        // return redirect()->intended('/admin/dashboard');
        return redirect()->route('dashboard')->with('success', "Admin login successfully....!");
    }
    
    
    public function getChartData(Request $request, $period = 'year')
    {
        try {
            if ($period === 'year') {
                $fy = $request->fy; // 2024-2025
                $data = $this->getCurrentFinancialYearData($fy);
            } else {
                $data = $this->getAllFinancialYearsData();
            }
    
            return response()->json([
                'success' => true,
                'sales' => $data['sales'],
                'purchases' => $data['purchases'],
                'labels' => $data['labels'],
                'jobs' => $data['jobs'],      
                'jobsOfMonth' => $data['jobsOfMonth'],      
                'totalSales' => $data['totalSales'],
                'totalPurchases' => $data['totalPurchases'],
                
                'fyStartYear' => $data['fyStartYear'],
                'fyEndYear' => $data['fyEndYear'],
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
            ]);
        }
    }

    private function getCurrentFinancialYearData($fy)
    {
        // FY format: 2024-2025
        list($startYear, $endYear) = explode('-', $fy);
    
        $startDate = $startYear . '-04-01';
        $endDate = $endYear . '-03-31';
        
        $startDateOfMonth = now()->startOfMonth()->toDateString(); 
        $endDateOfMonth = now()->endOfMonth()->toDateString();   
    
        $months = [];
        $salesArray = [];
        $purchaseArray = [];
        $jobsArray = [];
        
        // echo $startDate .'-'.$endDate; exit();
        
        $company_id = Auth::user()->company_id;
        
        $totalJobs = DB::table('operation_job_masters')
        ->where('company_id', $company_id)
        ->whereBetween('job_date', [$startDate, $endDate])
        ->count();
        
        $totalJobsMonthWise = DB::table('operation_job_masters')
        ->select(
            DB::raw("DATE_FORMAT(job_date, '%Y-%m') as month"),
            DB::raw("COUNT(*) as total_jobs")
        )
        ->where('company_id', $company_id)
        ->whereBetween('job_date', [$startDate, $endDate])
        ->groupBy('month')
        ->pluck('total_jobs', 'month');

        // SALES
        $sales = DB::table('account_sale_invoices AS si')
        ->leftJoin('account_sales_invoice_container AS sic', 'sic.sales_invoice_id', '=', 'si.id')
        ->select(
            DB::raw("DATE_FORMAT(si.invoice_date, '%Y-%m') as month"),
            DB::raw("SUM(sic.total) as total")
        )
        ->where('si.company_id', $company_id)
        ->whereBetween('si.invoice_date', [$startDate, $endDate])
        ->groupBy('month')
        ->pluck('total', 'month');
        
        $totalSales = DB::table('account_sale_invoices AS si')
        ->leftJoin('account_sales_invoice_container AS sic', 'sic.sales_invoice_id', '=', 'si.id')
        ->select(
            DB::raw("SUM(sic.total) as total")
        )
        ->where('si.company_id', $company_id)
        ->whereBetween('si.invoice_date', [$startDate, $endDate])
        ->value(DB::raw("COALESCE(SUM(sic.total), 0)"));
        
    
        // PURCHASE
        $purchases = DB::table('account_purchase_invoices AS pi')
        ->leftJoin('account_purchase_invoices_container  AS pic', 'pic.purchase_invoice_id', '=', 'pi.id')
        ->select(
            DB::raw("DATE_FORMAT(pi.invoice_date, '%Y-%m') as month"),
            DB::raw("SUM(pic.total) as total")
        )
        ->where('pi.company_id', $company_id)
        ->whereBetween('pi.invoice_date', [$startDate, $endDate])
        ->groupBy('month')
        ->pluck('total', 'month');
        
        $totalPurchases = DB::table('account_purchase_invoices AS pi')
        ->leftJoin('account_purchase_invoices_container  AS pic', 'pic.purchase_invoice_id', '=', 'pi.id')
        ->select(
            DB::raw("SUM(pic.total) as total")
        )
        ->where('pi.company_id', $company_id)
        ->whereBetween('pi.invoice_date', [$startDate, $endDate])
        ->value(DB::raw("COALESCE(SUM(pic.total), 0)"));
        
        
        // Loop April → March
        for ($m = 4; $m <= 12; $m++) {
            $key = $startYear . '-' . str_pad($m, 2, '0', STR_PAD_LEFT);
    
            $months[] = date('M', strtotime($key));
            $salesArray[] = $sales[$key] ?? 0;
            $purchaseArray[] = $purchases[$key] ?? 0;
            $jobsArray[$key] = $totalJobsMonthWise[$key] ?? 0;
        }
    
        for ($m = 1; $m <= 3; $m++) {
            $key = $endYear . '-' . str_pad($m, 2, '0', STR_PAD_LEFT);
    
            $months[] = date('M', strtotime($key));
            $salesArray[] = $sales[$key] ?? 0;
            $purchaseArray[] = $purchases[$key] ?? 0;
            $jobsArray[$key] = $totalJobsMonthWise[$key] ?? 0;
        }
    
        return [
            'labels' => $months,
            'sales' => $salesArray,
            'purchases' => $purchaseArray,
            'jobs' => $totalJobs,
            'jobsOfMonth' => $jobsArray,
            'totalSales' => $totalSales,
            'totalPurchases' => $totalPurchases,
            'fyStartYear' => $startYear,
            'fyEndYear' => $endYear
        ];
    }
    
    public function getMonthWiseChartData(Request $request, $period = 'year')
    {
        try {
            if ($period === 'year') {
                $fy = $request->fy; // 2024-2025
                $data = $this->getMonthWiseFinancialYearData($fy);
            } else {
                $data = $this->getAllFinancialYearsData();
            }
    
            return response()->json([
                'success' => true,
                'labels' => $data['labels'],
                'airImports' => $data['airImports'],      
                'airExports' => $data['airExports'],      
                'seaImports' => $data['seaImports'],
                'seaExports' => $data['seaExports'],
                
                'fyStartYear' => $data['fyStartYear'],
                'fyEndYear' => $data['fyEndYear'],
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
            ]);
        }
    }
    
    private function getMonthWiseFinancialYearData($fy)
    {
        // FY format: 2024-2025
        list($startYear, $endYear) = explode('-', $fy);
    
        $startDate = $startYear . '-04-01';
        $endDate = $endYear . '-03-31';
        
        $startDateOfMonth = now()->startOfMonth()->toDateString(); 
        $endDateOfMonth = now()->endOfMonth()->toDateString();   
    
        $months = [];
        $salesArray = [];
        $purchaseArray = [];
        $jobsArray = [];
        
        $company_id = Auth::user()->company_id;
        
        // $totalJobs = DB::table('operation_job_masters')
        // ->where('company_id', $company_id)
        // ->whereBetween('job_date', [$startDate, $endDate])
        // ->count();
        
        $totalJobsAirImportMonthWise = DB::table('operation_job_masters')
        ->select(
            DB::raw("DATE_FORMAT(job_date, '%Y-%m') as month"),
            DB::raw("COUNT(*) as total_jobs")
        )
        ->where('company_id', $company_id)
        ->where('job_activity', 'AIRIMP.FWD')
        ->whereBetween('job_date', [$startDate, $endDate])
        ->groupBy('month')
        ->pluck('total_jobs', 'month');
        
        $totalJobsAirExportMonthWise = DB::table('operation_job_masters')
        ->select(
            DB::raw("DATE_FORMAT(job_date, '%Y-%m') as month"),
            DB::raw("COUNT(*) as total_jobs")
        )
        ->where('company_id', $company_id)
        ->where('job_activity', 'AIREXP.FWD')
        ->whereBetween('job_date', [$startDate, $endDate])
        ->groupBy('month')
        ->pluck('total_jobs', 'month');
        
        $totalJobsSeaImportMonthWise = DB::table('operation_job_masters')
        ->select(
            DB::raw("DATE_FORMAT(job_date, '%Y-%m') as month"),
            DB::raw("COUNT(*) as total_jobs")
        )
        ->where('company_id', $company_id)
        ->where('job_activity', 'SEAIMP.FWD')
        ->whereBetween('job_date', [$startDate, $endDate])
        ->groupBy('month')
        ->pluck('total_jobs', 'month');
        
        $totalJobsSeaExportMonthWise = DB::table('operation_job_masters')
        ->select(
            DB::raw("DATE_FORMAT(job_date, '%Y-%m') as month"),
            DB::raw("COUNT(*) as total_jobs")
        )
        ->where('company_id', $company_id)
        ->where('job_activity', 'SEAEXP.FWD')
        ->whereBetween('job_date', [$startDate, $endDate])
        ->groupBy('month')
        ->pluck('total_jobs', 'month');
     
        // Loop April → March
        for ($m = 4; $m <= 12; $m++) {
            $key = $startYear . '-' . str_pad($m, 2, '0', STR_PAD_LEFT);
    
            $months[] = date('M', strtotime($key));
            $salesArray[] = $sales[$key] ?? 0;
            $purchaseArray[] = $purchases[$key] ?? 0;
            $jobsArray[$key] = $totalJobsMonthWise[$key] ?? 0;
        }
    
        for ($m = 1; $m <= 3; $m++) {
            $key = $endYear . '-' . str_pad($m, 2, '0', STR_PAD_LEFT);
    
            $months[] = date('M', strtotime($key));
            $salesArray[] = $sales[$key] ?? 0;
            $purchaseArray[] = $purchases[$key] ?? 0;
            $jobsArray[$key] = $totalJobsMonthWise[$key] ?? 0;
        }
    
        return [
            'labels' => $months,
            
            'airImports' => $totalJobsAirImportMonthWise,
            'airExports' => $totalJobsAirExportMonthWise,
            'seaImports' => $totalJobsSeaImportMonthWise,
            'seaExports' => $totalJobsSeaExportMonthWise,
        
            'fyStartYear' => $startYear,
            'fyEndYear' => $endYear
        ];
    }

    
    // public function logout(Request $request)
    // {
    //     $user = auth()->user();
    //     $this->guard()->logout();

    //     $request->session()->invalidate();
    //     if (module_enabled('Subdomain')) {
    //         if ($user->super_admin == 1) {
    //             return $this->loggedOut($request) ?: redirect(route('front.super-admin-login'));
    //         }
    //     }

    //      return $this->loggedOut($request) ?: redirect('/');
    // }
    
    public function logout(Request $request)
    {
        Auth::logout();
    
        return redirect('/');
    }

    
    public function register(){
        return view('w3crm.page.register');
    }
    
    public function store(Request $request)
    {
        // VALIDATION
        $request->validate([
            'company_name'  => 'required|string|max:255',
            'company_email' => 'required|email|max:255|unique:companies,company_email',
            'company_phone' => 'required|string|max:20',
    
            'username' => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'phone'    => 'required|string|max:20',
    
            'password' => 'required|min:6|confirmed',
        ]);
    
        // 1. CREATE COMPANY
        $company = Company::create([
            'company_name'  => $request->company_name,
            'company_email' => $request->company_email,
            'company_phone' => $request->company_phone,
            'address'       => null,
            'website'       => null,
            'status'        => 'active',
        ]);
    
        // 2. FETCH EXISTING super-admin ROLE
        $role = Role::where('name', 'super-admin')->first();
    
        // 3. CREATE USER
        $user = User::create([
            'name'       => $request->username,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'company_id' => $company->id,
            'status'     => 'active',
            'role'     => 'admin',
        ]);
    
        // 4. ASSIGN EXISTING ROLE
        $user->assignRole($role);
    
        // 5. LOGIN USER
        Auth::login($user);
    
        // 6. REDIRECT
        return redirect()->route('dashboard');
    }


    
    public function page_register(){
        $page_title = 'Register';
        $page_description = 'Some description for the page';
        return view('w3crm.page.register', compact('page_title', 'page_description'));
    }
    
    public function page_forgot_password(){
        $page_title = 'Forgot Password';
        $page_description = 'Some description for the page';
        return view('w3crm.page.forgot_password', compact('page_title', 'page_description'));
    }

    public function page_error_400(){
        $page_title = 'Error 400';
        $page_description = 'Some description for the page';
        return view('w3crm.page.error_400', compact('page_title', 'page_description'));
    }
    public function page_error_403(){
        $page_title = 'Error 403';
        $page_description = 'Some description for the page';
        return view('w3crm.page.error_403', compact('page_title', 'page_description'));
    }
    public function page_error_404(){
        $page_title = 'Error 404';
        $page_description = 'Some description for the page';
        return view('w3crm.page.error_404', compact('page_title', 'page_description'));
    }
    public function page_error_500(){
        $page_title = 'Error 500';
        $page_description = 'Some description for the page';
        return view('w3crm.page.error_500', compact('page_title', 'page_description'));
    }
    public function page_error_503(){
        $page_title = 'Error 503';
        $page_description = 'Some description for the page';
        return view('w3crm.page.error_503', compact('page_title', 'page_description'));
    }
}
