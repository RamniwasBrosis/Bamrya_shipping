<?php

namespace App\Http\Controllers\AdminMain\Operations;

use Illuminate\Http\Request;
use App\Models\MasterImportParty;
use App\Models\MasterExportParty;
use App\Models\MasterBillingParty;
use App\Models\MasterParty;
use App\Models\CompanySetting;
use App\Http\Controllers\Controller;
use App\Models\Operations\OperationJobMaster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Validated;
use Illuminate\Validation\ValidationException;
use App\Models\Operations\OperationEnquiries;
use App\Models\MasterPort;

class JobMasterController extends Controller
{

    public $company_id ;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->company_id = Auth::user()->company_id;
            $this->user_id = auth()->user()->id;
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page_title = "Job Master";
        $query = OperationJobMaster::with(['consigneeName', 'shipperName']);

        // Filter by job date
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('job_date', [$request->start_date, $request->end_date]);
        }

        // Filter by job activity
        if ($request->filled('job_activity')) {
            $query->where('job_activity', 'LIKE', '%' . $request->job_activity . '%');
        }
        
        // job number
        if ($request->filled('job_number')) {
            $query->where('id', 'LIKE', '%' . $request->job_number . '%');
        }
        // Filter by party name
        if ($request->filled('shipper_parties')) {
            $query->whereIn('job_activity', ['AIREXP.FWD', 'SEAEXP.FWD', 'SEAEXP.NVOCC'])
                  ->where('job_party_id', 'LIKE', '%' .$request->shipper_parties. '%');
        }
    
        //  Filter by Consignee Party (Import Party)
        if ($request->filled('consignee_parties')) {
            $query->whereIn('job_activity', ['AIRIMP.FWD', 'SEAIMP.FWD'])
                  ->where('job_party_id', $request->consignee_parties);
        }
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }

        // Always restrict to current company
        $query->where('company_id', $this->company_id);
        
        $jobs = $query->orderBy('created_at', 'desc')->get();

        $job_masters = $query->orderBy('created_at', 'desc')->paginate(25);

        $shipperPartyNames = MasterExportParty::where('company_id', $this->company_id)->get();
        $consigneePartyNames = MasterImportParty::where('company_id', $this->company_id)->get();

        return view('admin-main.admin.jobMaster.index', compact('job_masters', 'shipperPartyNames', 'consigneePartyNames', 'jobs','page_title'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $importParties = MasterImportParty::where('company_id', $this->company_id)->where('party_type', 1)->where('status', 1)->get();
        $enquiries = OperationEnquiries::where('company_id', $this->company_id)->whereIn('enquiry_status', ['Active','Order'])->get();
        $exportParties = MasterExportParty::where('company_id', $this->company_id)->where('status', 1)->get();
        $party_lists = MasterParty::whereIn('party_type', [1, 2])->get();
        $company_code = CompanySetting::select('company_code')
                ->where('company_id', $this->company_id)
                ->first();
        $lastJob = OperationJobMaster::where('company_id', $this->company_id)
            ->latest('job_no')
            ->first();
        
        $nextJobNo = $lastJob ? $lastJob->job_no + 1 : 1;
        
        
        return view('admin-main.admin.jobMaster.create', compact('exportParties', 'importParties', 'party_lists', 'company_code','nextJobNo','enquiries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'bl_issue'               => 'required|string',
            'job_date'               => 'required|date',
            'job_activity'           => 'required|string|max:50',
            'job_party_id'           => 'required',
            'job_remarks'            => 'nullable|string|max:500',
            'term'                   => 'nullable|string',
            'enquiry_reference_no'   => 'nullable|max:50',
            'job_activity_type'      => 'required|in:1,2',
            'shipment_type'          => 'required|in:FCL,LCL,AIR',
            'job_status'             => 'required|in:O,C',
            'insurance'              => 'required|in:Y,N',
            'clearance'              => 'required|in:Y,N',
            'transportation'         => 'required|in:Y,N',
            'booking_date'           => 'required|date',
            'cargo_ready_date'       => 'nullable|date',
            'pickup_date'            => 'required|date',
        ]);
        
        if($request->job_activity == 'AIRIMP.FWD'){
            $pre = 'AI';
        }elseif($request->job_activity == 'AIREXP.FWD'){
            $pre = 'AE';
        }elseif($request->job_activity == 'SEAIMP.FWD'){
            $pre = 'SI';
        }elseif($request->job_activity == 'SEAEXP.FWD'){
            $pre = 'SE';
        }elseif($request->job_activity == 'SEAIMP.NVOCC'){
            $pre = 'SI';
        }elseif($request->job_activity == 'SEAEXP.NVOCC'){
            $pre = 'SE';
        }
        
        // Check Party Approval
        if($request->job_activity == 'AIRIMP.FWD' || $request->job_activity == 'SEAIMP.FWD' || $request->job_activity == 'SEAIMP.NVOCC'){
            $checkPartyApproval = MasterImportParty::select('approval')->where('company_id', $this->company_id)->find($request->job_party_id);
        }else{
            $checkPartyApproval = MasterExportParty::select('approval')->where('company_id', $this->company_id)->find($request->job_party_id);
        }

        if($checkPartyApproval->approval == null){
            return redirect()->back()->with('error', 'This Party has not Approved.');
        }
        
        $month = date('n');
        $year = date('Y');
        if ($month < 4) {
            $fyStart = $year - 1;
            $fyEnd = $year;
        } else {
            $fyStart = $year;
            $fyEnd = $year + 1;
        }
        $financialYear = $fyStart . '-' . substr($fyEnd, -2);
        
        $setting  = DB::table('company_settings')->where('company_id', $this->company_id)->first();
        $lastJob = OperationJobMaster::where('company_id', $this->company_id)->orderBy('job_no', 'desc')->first();
        
        if (!$lastJob) {
            if (empty($setting->job_no)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Starting JOB NUMBER value is empty. Please enter first job number in company settings.'
                ], 200);
            }
    
            $nextJobNo = $setting->job_no;
            $company_code = $setting ->company_code.'/' ?? '';
    
            // Update old_job_no for the first time
            DB::table('company_settings')
                ->where('company_id', $this->company_id)
                ->update(['old_job_no' => $setting->job_no]);
        }
        elseif ($setting->old_job_no != $setting->job_no) {
            
             // First Check Job Number Already Exist ya Not
            $JobNumberCheck = OperationJobMaster::where('company_id', $this->company_id)->where('job_no', $setting->job_no)->first();
            if($JobNumberCheck){
                return response()->json([
                    'status' => false,
                    'message' => 'Starting Job Number already exists. Enter another starting job number in company settings.'
                ], 200);
            }

            $nextJobNo = $setting->job_no;
            $company_code = $setting ->company_code.'/' ?? '';
    
            DB::table('company_settings')
                ->where('company_id', $this->company_id)
                ->update(['old_job_no' => $setting->job_no]);
        }
        else {
            $nextJobNo = $lastJob->job_no + 1;
            $company_code = $setting ->company_code.'/' ?? '';
        }

        $full_job_number = $pre.'/'.$company_code.$nextJobNo.'/'.$financialYear;
        
        $jobMaster = new OperationJobMaster();
        $jobMaster->company_id = Auth::user()->company_id;
        $jobMaster->issued_by = $request->bl_issue;
        $jobMaster->job_no = $nextJobNo; 
        $jobMaster->full_job_no = $full_job_number; 
        $jobMaster->bl_type_prefix = $pre; 
        $jobMaster->job_date = $request->job_date;
        $jobMaster->job_activity = $request->job_activity;
        $jobMaster->job_party_id = $request->job_party_id;
        $jobMaster->job_remarks = $request->job_remarks;

        $jobMaster->term = $request->term;
        $jobMaster->enquiry_reference_no = $request->enquiry_reference_no;
        $jobMaster->job_activity_type = $request->job_activity_type;
        $jobMaster->shipment_type = $request->shipment_type;
        $jobMaster->job_status = $request->job_status;
        $jobMaster->insurance = $request->insurance;
        $jobMaster->clearance = $request->clearance;
        $jobMaster->transportation = $request->transportation;
        $jobMaster->booking_date = $request->booking_date;
        $jobMaster->cargo_ready_date = $request->cargo_ready_date;
        $jobMaster->pickup_date = $request->pickup_date;
        $jobMaster->user_id = $this->user_id;

        $jobMaster->save();
        
        //status change to used of enquires
        if ($request->filled('enquiry_reference_no')) {

            $enquiry = OperationEnquiries::find($request->enquiry_reference_no);
        
            if ($enquiry) {
                $enquiry->update([
                    'enquiry_status' => 'Complete'
                ]);
            }
        }
  
        return redirect()->back()->with('success', 'Job Master created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jobMaster = OperationJobMaster::find($id);
        
        if(!$jobMaster){
            return redirect()->back()->with('error', 'Record not found.');
        }
        
        $parties = '';
        $partyDetails = '';
        $enquiries = OperationEnquiries::where('company_id', $this->company_id)->where('enquiry_status', 'Complete')->get();
        if($jobMaster->job_activity == 'AIRIMP.FWD' || $jobMaster->job_activity == 'SEAIMP.FWD' || $jobMaster->job_activity == 'SEAIMP.NVOCC'){
            $partyDetails = MasterImportParty::where('company_id', $this->company_id)->where('status', 1)->find($jobMaster->job_party_id);
            $parties = MasterImportParty::where('company_id', $this->company_id)->where('party_type', 1)->where('status', 1)->get();
        }else{
            $partyDetails = MasterExportParty::where('company_id', $this->company_id)->where('status', 1)->find($jobMaster->job_party_id);
            $parties = MasterExportParty::where('company_id', $this->company_id)->where('status', 1)->get();
        }
        
        $company_code = CompanySetting::select('company_code')
                ->where('company_id', $this->company_id)
                ->first();

        $party_lists  = MasterParty::all();
        return view('admin-main.admin.jobMaster.edit', compact('jobMaster', 'parties', 'party_lists','partyDetails', 'company_code','enquiries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validated = $request->validate([
                'bl_issue'               => 'required|string',
                'job_date'               => 'required|date',
                'job_activity'           => 'required|string|max:50',
                'job_party_id'           => 'required',
                'job_remarks'            => 'nullable|string|max:500',
                'term'                   => 'nullable|string',
                'enquiry_reference_no'   => 'nullable|max:50',
                'job_activity_type'      => 'required|in:1,2',
                'shipment_type'          => 'required|in:FCL,LCL,AIR',
                'job_status'             => 'required|in:O,C',
                'insurance'              => 'required|in:Y,N',
                'clearance'              => 'required|in:Y,N',
                'transportation'         => 'required|in:Y,N',
                'booking_date'           => 'required|date',
                'cargo_ready_date'       => 'nullable|date',
                'pickup_date'            => 'required|date',
            ]);
        } catch (ValidationException $e) {
            dd($e->validator->errors()); // This will show you exactly what's failing
        }
        
        if($request->job_activity == 'AIRIMP.FWD'){
            $pre = 'AI';
        }elseif($request->job_activity == 'AIREXP.FWD'){
            $pre = 'AE';
        }elseif($request->job_activity == 'SEAIMP.FWD'){
            $pre = 'SI';
        }elseif($request->job_activity == 'SEAEXP.FWD'){
            $pre = 'SE';
        }elseif($request->job_activity == 'SEAIMP.NVOCC'){
            $pre = 'SI';
        }elseif($request->job_activity == 'SEAEXP.NVOCC'){
            $pre = 'SE';
        }
        
        $month = date('n');
        $year = date('Y');
        if ($month < 4) {
            $fyStart = $year - 1;
            $fyEnd = $year;
        } else {
            $fyStart = $year;
            $fyEnd = $year + 1;
        }
        $financialYear = $fyStart . '-' . substr($fyEnd, -2);
        
        $setting  = DB::table('company_settings')->where('company_id', $this->company_id)->first();
        
        $full_job_number = $pre.'/'.$setting ->company_code.'/'.$request->job_no.'/'.$financialYear;
        
        $jobMaster =  OperationJobMaster::find($id);

        $jobMaster->issued_by = $request->bl_issue;
        $jobMaster->job_no = $request->job_no; 
        $jobMaster->job_date = $request->job_date;
        $jobMaster->job_activity = $request->job_activity;
        $jobMaster->job_party_id = $request->job_party_id;
        $jobMaster->job_remarks = $request->job_remarks;
        $jobMaster->full_job_no = $full_job_number;

        $jobMaster->term = $request->term;
        $jobMaster->enquiry_reference_no = $request->enquiry_reference_no;
        $jobMaster->job_activity_type = $request->job_activity_type;
        $jobMaster->shipment_type = $request->shipment_type;
        $jobMaster->job_status = $request->job_status;
        $jobMaster->insurance = $request->insurance;
        $jobMaster->clearance = $request->clearance;
        $jobMaster->transportation = $request->transportation;
        $jobMaster->booking_date = $request->booking_date;
        $jobMaster->cargo_ready_date = $request->cargo_ready_date;
        $jobMaster->pickup_date = $request->pickup_date;
        $jobMaster->user_id = $this->user_id;


        $jobMaster->save();

        return redirect()->back()->with('success', 'Job Master updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobMaster =  OperationJobMaster::find($id);
        $jobMaster->delete();

        return response()->json(['success' => 'job record deleted successfull']);
    }
    
    public function storeNewPartyAjax(Request $request)
    {
        $rules = [
            'party_name'      => 'required|string|max:255',
            'address_1'       => 'required|string|max:255',
            'party_type'      => 'required|integer',
            'status'          => 'required|boolean',
        ];
    
        // Check approval condition
        $query = DB::table('master_parties_enable_features')
            ->where('company_id', $this->company_id);
            
        if($request->party_type == 2){
            $checkApproval = $query->where('isShipper', 1)
            ->first();
        }else{
            $checkApproval = $query->where('isOtherParties', 1)
            ->first();
        }
        
        if ($checkApproval && $checkApproval->isFeatured == 1) {
            // Documents optional
            $rules['documents'] = 'nullable|array';
            $rules['documents.*'] = 'file|mimes:pdf,doc,docx,jpg,png|max:5120';
        } else {
            // Documents mandatory
            $rules['documents'] = 'required|array|min:1';
            $rules['documents.*'] = 'required|file|mimes:pdf,doc,docx,jpg,png|max:5120';
        }

        $validated = $request->validate($rules);
        
        // print_r($request->all()); exit();
        
        $paths = [];
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('party-documents', 'public');
        
                $paths[] = [
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'type' => $file->getClientMimeType(),
                    'size' => $file->getSize(),
                ];
            }
        }
        
        $existsInImport = false;
        $existsInExport = false;
        if($request->party_type == 2){
            $existsInExport = \DB::table('master_export_parties')
            ->where('party_name', $request->party_name)
            ->where('id', '!=', $request->id) 
            ->exists();
        }else{
            $existsInImport = \DB::table('master_import_parties')
            ->where('party_name', $request->party_name)
            ->where('id', '!=', $request->id) 
            ->whereNotIn('party_type', [1, 2])
            ->exists();
        }
        
        if ($existsInImport || $existsInExport) {
            $msg = $request->party_type == 2 ? 'Party name already exists in Export parties.' : 'Party name already exists in Import parties.' ;
            return response()->json([
                'success' => false,
                'message' => $msg
            ]);
        }
        
        $model = $request->party_type == 2 ? MasterExportParty::class : MasterImportParty::class;
        $masterParty = $model::create([
            'company_id' => $this->company_id,
            'uuid' => Str::uuid(),
            'party_code' => $request->party_code,
            'party_name' => $request->party_name,
            'address_line1'  => $request->address_1,
            'address_line2'  => $request->address_2,
            'city'       => $request->city,
            'pincode'    => $request->pincode,
            'party_type' => $request->party_type,
            'contact_person' => $request->contact_person,
            'tel_no' => $request->tel_no,
            'email'  => $request->email,
            'gstin'  => $request->gstin,
            'pan_no' => $request->pan_no,
            'cin_no' => $request->cin_no,
            'credit_days' => $request->credit_days,
            'tds_percent' => $request->tds_percent,
            'document' => $paths,
            'party_mode' => $request->party_mode,
            'status' => $request->status,
        ]);
        
        $this->addBillingParty($request->all());
        
        
     
        return response()->json([
            'status' => 'success',
            'message'  => 'Successfully add new prty',
            'party' => [
                'id' => $masterParty->id,
                'name' => $masterParty->party_name,
            ]
            
        ]);
    }
    
    private function addBillingParty($validated)
    {
        
        MasterBillingParty::create([
            
            'company_id' => $this->company_id,
            'uuid' => Str::uuid(),
        
            "party_code" => $validated['party_code'],
            "party_name" => $validated['party_name'],
            "address_1" => $validated['address_1'],
            "address_2" => $validated['address_2'],
            "city" => $validated['city'],
            "pincode" => $validated['pincode'],
            "party_type" => $validated['party_type'],
            "contact_person" => $validated['contact_person'],
            
            "tel_no" => $validated['tel_no'],
            "email" => $validated['email'],
            "gstin" => $validated['gstin'],
            "pan_no" => $validated['pan_no'],
            "cin_no" => $validated['cin_no'],
            "credit_days" => $validated['credit_days'],
            "tds_percent" => $validated['tds_percent'],
            "status" => $validated['status']
        ]);
    }
    
    public function getEnquiryDetails($id)
    {
        $enquiry = OperationEnquiries::where('company_id', $this->company_id)
            ->with([
                'loadingPort:id,port_name',
                'dischargePort:id,port_name',
                'consignee:id,party_name'
            ])
            ->findOrFail($id);
    
        return response()->json([
            'status' => true,
            'data' => $enquiry
        ]);

    }
    
    
}
