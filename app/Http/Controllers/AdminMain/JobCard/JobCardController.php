<?php

namespace App\Http\Controllers\AdminMain\JobCard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;

class JobCardController extends Controller
{
    public $company_id ;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->company_id = Auth::user()->company_id;
            return $next($request);
        });
    }
    
    public function airJobCard()
    {
        return view('admin-main.admin.JobCard.air-job-card');
    }
    
    public function printAirJobCard(Request $request)
    {
        $data = $request->all();
        
        $company = Company::with(['companySetting', 'companyBranch'])
            ->where('id', $this->company_id)
            ->first();
            
        $logoUrl = $company->logo
            ? public_path('uploads/company_logo/' . $company->logo)
            : public_path('images/default-logo.png');
        
        return view('admin-main.admin.JobCard.print-air-way-job-card', compact('data', 'logoUrl', 'company'));
    
        // $pdf = Pdf::loadView(
        //     'admin-main.admin.JobCard.print-air-way-job-card',
        //     compact('data')
        // )->setPaper('a4', 'portrait');
    
        // // Open + Print
        // return $pdf->stream('air-job-card.pdf');
    }
    
    public function seaJobCard()
    {
        return view('admin-main.admin.JobCard.sea-job-card');
    }
    
    public function printSeaJobCard(Request $request)
    {
        $data = $request->all();
        
        $company = Company::with(['companySetting', 'companyBranch'])
            ->where('id', $this->company_id)
            ->first();
            
        $logoUrl = $company->logo
            ? public_path('uploads/company_logo/' . $company->logo)
            : public_path('images/default-logo.png');
        
        return view('admin-main.admin.JobCard.print-sea-job-card', compact('data', 'logoUrl', 'company'));
    }
}
