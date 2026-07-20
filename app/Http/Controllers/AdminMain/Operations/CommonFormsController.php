<?php

namespace App\Http\Controllers\AdminMain\Operations;

use App\Models\MasterPort;
use App\Models\MasterCharge;
use Illuminate\Support\Str;
use App\Models\MasterVessel;
use App\Models\MasterBlType;
use App\Models\MasterPackage;
use App\Models\Operations\OperationJobMaster;
use App\Models\Operations\OperationOtherPartiesName;
use Illuminate\Http\Request;
use App\Models\MasterImportParty;
use App\Models\MasterExportParty;
use App\Models\Accounts\PurchaseParties;
use App\Models\MasterForwarder;
use App\Models\MasterShipping;
use App\Models\Operations\OperationSalesPerson;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

use App\Models\Operations\OperationAirExport;
use App\Models\Operations\OperationAirImport;
use App\Models\Operations\OperationSeaExport;
use App\Models\Operations\OperationSeaImport;
use App\Models\User;

use App\Notifications\newPartyNotification;
use Illuminate\Support\Facades\Notification;

class CommonFormsController extends Controller
{
    public $company_id ;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->company_id = Auth::user()->company_id;
            $this->user_id = auth()->user()->id;
            return $next($request);
        });
    }

    public function CommonVesselForms(Request $request){
        $request->validate([
            'vessel_name' => 'required|string|max:255',
            'call_sign' => 'nullable|string|max:255',
            'imo_code' => 'nullable|string|max:255',
            'status' => 'required|in:1,0,2',
        ]);

        $vessel = new MasterVessel();

        $vessel->company_id = $this->company_id;
        $vessel->vessel_name = $request->vessel_name;
        $vessel->call_sign = $request->call_sign;
        $vessel->imo_code = $request->imo_code;
        $vessel->status = $request->status;
        $vessel->user_id = $this->user_id;
        $vessel->uuid = Str::uuid();

        $vessel->save();

         return response()->json([
            'success' => true,
            'id' => $vessel->id,
            'vessel_name' => $vessel->vessel_name,
        ]);
        // return redirect()->back()->with('success', 'Add a new vessels entry. !');
    }

    public function CommonPortForms(Request $request){
        $validated = $request->validate([
            'port_code' => 'nullable|string|max:255',
            'port_name' => 'required|string|max:255',

            'edi_code' => 'nullable|string|max:255',
            'jnpt_code' => 'nullable|string|max:255',
            'nsict_code' => 'nullable|string|max:255',

            'nsict_group_code' => 'nullable|string|max:255',
            'gti_code' => 'nullable|string|max:255',
            'gti_group_code' => 'nullable|string|max:255',
            'nsi_gt_code' => 'nullable|string|max:255',

            'status' => 'required|in:1,0',
        ]);

        $port = new MasterPort();
        $port->company_id = $this->company_id;
        $port->uuid = Str::uuid();

        $port->port_code = $request->port_code;
        $port->port_name = $request->port_name;
        $port->edi_code = $request->edi_code;
        $port->jnpt_code = $request->jnpt_code;
        $port->nsict_code = $request->nsict_code;
        $port->nsict_group_code = $request->nsict_group_code;
        $port->gti_code = $request->gti_code;
        $port->gti_group_code = $request->gti_group_code;
        $port->nsi_gt_code = $request->nsi_gt_code;
        $port->status = $request->status;
        $port->user_id = $this->user_id;

        $port->save();       

        // return redirect()->back()->with('success', 'Port entry create successfully.');
        
        return response()->json([
            'success' => true,
            'port' => [
                'id' => $port->id,
                'name' => $port->port_name
            ]
        ]);
    }

    public function CommonPartyForms(Request $request){
        
        // Base rules
        $rules = [
            'party_code'      => 'nullable|string|max:255',
            'party_name'      => 'required|string|max:255',
            'address_1'       => 'required|string|max:255',
            'address_2'       => 'nullable|string|max:255',
            'address_3'       => 'nullable|string|max:255',
            'ledger_name'     => 'nullable|string|max:255',
            'city'            => 'nullable|string|max:255',
            'pincode'         => 'nullable|string|max:20',
            'party_type'      => 'required|string|max:100',
            'contact_person'  => 'nullable|string|max:255',
            'tel_no'          => 'nullable|string|max:20',
            'email'           => 'nullable|email|max:255',
            'gstin'           => 'nullable|string|max:20',
            'state_code'           => 'nullable|string|max:50',
            'state'           => 'nullable|string|max:50',
            'pan_no'          => 'nullable|string|max:10',
            'cin_no'          => 'nullable|string|max:21',
            'credit_days'     => 'nullable|integer|min:1',
            'tds_percent'     => 'nullable|integer|min:0|max:100',
            'status'          => 'required|boolean',
        ];
        
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        $validated = $validator->validated();
 
        $existsInImport = false;
        $existsInExport = false;
        $existsInOtherType = false;
        
        // Custom check for both tables
        if($request->party_type == 1 || $request->party_type == 6){
            $existsInImport = \DB::table('master_import_parties')
            ->where('party_name', $request->party_name)
            ->where('party_type', $request->party_type)
            ->exists();
        }else if($request->party_type == 2){
            $existsInExport = \DB::table('master_export_parties')
            ->where('party_name', $request->party_name)
            ->exists();
        }else{
            $existsInOtherType = \DB::table('master_import_parties')
            ->where('party_name', $request->party_name)
            ->where('party_type', $request->party_type)
            ->exists();
        }
        
       if ($existsInImport || $existsInOtherType || $existsInExport) {
            $message = $existsInExport
                ? 'Party name already exists in Export parties.'
                : 'Party name already exists in Import parties.';
        
            return response()->json([
                'success' => false,
                'message' => $message
            ]);
        }

        

        if($request->party_type == 2)
        {
            $masterParty =  new MasterExportParty();
        }
        else{
            $masterParty =  new MasterImportParty();
        }

        
        $masterParty->company_id = $this->company_id;
        $masterParty->uuid = Str::uuid();

        $masterParty->party_code = $validated['party_code'];
        $masterParty->party_name = $validated['party_name'];

        $masterParty->address_line1 = $validated['address_1'];
        $masterParty->address_line2 = $validated['address_2'];
     
        $masterParty->city = $validated['city'];
        $masterParty->pincode = $validated['pincode'];
        $masterParty->party_type = $validated['party_type'];
        $masterParty->party_mode = 'foreign';
        $masterParty->contact_person = $validated['contact_person'];

        $masterParty->tel_no = $validated['tel_no'];
        $masterParty->email = $validated['email'];
        $masterParty->gstin = $validated['gstin'];
        $masterParty->pan_no = $validated['pan_no'];

        $masterParty->cin_no = $validated['cin_no'];
        $masterParty->credit_days = $validated['credit_days'];
        $masterParty->tds_percent = $validated['tds_percent'];
        $masterParty->state = $validated['state'];
        $masterParty->state_code = $validated['state_code'];
        $masterParty->status = $validated['status'];
        $masterParty->user_id = $this->user_id;

        if(!$validated['party_code']){
            $masterParty->party_code = '0';
        }
        if($request->filled('ledger_name')){
            $masterParty->tally_ledger = $request->ledger_name;
        }

        $masterParty->save();
        
        // $admins = User::where('role', 'super-admin')->where('company_id', $this->company_id)->get();
        // Notification::send($admins, new newPartyNotification($masterParty, $request->party_type));
        
        return response()->json([
            'success' => true,
            'party' => [
                'id' => $masterParty->id,
                'name' => $masterParty->party_name,
            ]
        ]);
    }
    
    public function CommonPartyFormsEdit(Request $request)
    {
        
        // Base rules
        $rules = [
            'party_code'      => 'nullable|string|max:255',
            'party_name'      => 'required|string|max:255',
            'address_1'       => 'required|string|max:255',
            'address_2'       => 'nullable|string|max:255',
            'city'            => 'nullable|string|max:255',
            'pincode'         => 'nullable|string|max:20',
            'party_type'      => 'required|string|max:100',
            'contact_person'  => 'nullable|string|max:255',
            'tel_no'          => 'nullable|string|max:20',
            'email'           => 'nullable|email|max:255',
            'gstin'           => 'nullable|string|max:20',
            'state'           => 'nullable|string|max:50',
            'state_code'      => 'nullable|string|max:50',
            'pan_no'          => 'nullable|string|max:10',
            'cin_no'          => 'nullable|string|max:21',
            'credit_days'     => 'nullable|integer|min:1',
            'tds_percent'     => 'nullable|integer|min:0|max:100',
            'status'          => 'required|boolean',
        ];
    
        // Check approval condition
        // $query = DB::table('master_parties_enable_features')
        //     ->where('company_id', $this->company_id);
            
        // if($request->party_type == 2){
        //     $checkApproval = $query->where('isShipper', 1)
        //     ->first();
        // }else{
        //     $checkApproval = $query->where('isOtherParties', 1)
        //     ->first();
        // }
    
        // if ($checkApproval && $checkApproval->isFeatured == 1) {
        //     $rules['documents.*'] = 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:5120';
        // }else{
        //     $rules['documents.*'] = 'required|file|mimes:pdf,doc,docx,jpg,png|max:5120';
        // }
    
        $validated = $request->validate($rules);
        
        // $paths = [];
    
        // if ($request->hasFile('documents')) {
        //     foreach ($request->file('documents') as $file) {
        //         $path = $file->store('party-documents', 'public');
        
        //         $paths[] = [
        //             'name' => $file->getClientOriginalName(),
        //             'path' => $path,
        //             'type' => $file->getClientMimeType(),
        //             'size' => $file->getSize(),
        //         ];
        //     }
        // }
    
        $existsInImport = false;
        $existsInExport = false;
        $existsInOtherType = false;
        
        // Custom check for both tables
        if($request->party_type == 1 || $request->party_type == 6){
            $existsInImport = \DB::table('master_import_parties')
            ->where('party_name', $request->party_name)
            ->where('id', '!=', $request->id) 
            ->exists();
        }else if($request->party_type == 2){
            $existsInExport = \DB::table('master_export_parties')
            ->where('party_name', $request->party_name)
            ->where('id', '!=', $request->id) 
            ->exists();
        }else{
            $existsInOtherType = \DB::table('master_import_parties')
            ->where('party_name', $request->party_name)
            ->where('id', '!=', $request->id) 
            ->whereNotIn('party_type', [1, 2])
            ->exists();
        }
        
        if ($existsInImport || $existsInExport || $existsInOtherType) {
            return response()->json([
                'success' => false,
                'message' => 'Party name already exists in Import or Export parties.'
            ]);
        }
        
        
        $masterParty ;
        if($validated['party_type'] == 1)
        {
            $masterParty =  MasterImportParty::find($request->id);
        }
        elseif($validated['party_type'] == 2)
        {
            $masterParty =  MasterExportParty::find($request->id);
        }
        else{
            $masterParty =  MasterImportParty::find($request->id);
        }
        
        // $masterParty->company_id = $this->company_id;
        // $masterParty->uuid = Str::uuid();

        $masterParty->party_code = $validated['party_code'];
        $masterParty->party_name = $validated['party_name'];

        $masterParty->address_line1 = $validated['address_1'];
        $masterParty->address_line2 = $validated['address_2'];
        // $masterParty->address_line3 = $validated['address_3'];
     
        $masterParty->city = $validated['city'];
        $masterParty->pincode = $validated['pincode'];
        $masterParty->party_type = $validated['party_type'];
        $masterParty->contact_person = $validated['contact_person'];

        $masterParty->tel_no = $validated['tel_no'];
        $masterParty->email = $validated['email'];
        $masterParty->gstin = $validated['gstin'];
        $masterParty->pan_no = $validated['pan_no'];

        $masterParty->cin_no = $validated['cin_no'];
        $masterParty->credit_days = $validated['credit_days'];
        $masterParty->tds_percent = $validated['tds_percent'];
        // $masterParty->document = $paths;
        $masterParty->state = $validated['state'];
        $masterParty->state_code = $validated['state_code'];
        $masterParty->status = $validated['status'];
        $masterParty->user_id = $this->user_id;

        if(!$validated['party_code']){
            $masterParty->party_code = '0';
        }
        if($request->filled('ledger_name')){
            $masterParty->tally_ledger = $request->ledger_name;
        }

        $masterParty->save();
        // return redirect()->back()->with('success', 'Party created successfully.');
        
        return response()->json([
            'success' => true,
            'party' => [
                'id' => $masterParty->id,
                'name' => $masterParty->party_name,
            ]
        ]);
    }
    
    public function forwarderForms(Request $request)
    {
  
        $validated = $request->validate([
            'party_code'      => 'nullable|string|max:50',
            'party_name'      => 'required|string|max:100',
            'tally_ledger'    => 'nullable|string|max:100',
            'address_line1'   => 'nullable|string|max:200',
            'address_line2'   => 'nullable|string|max:200',
            'address_line3'   => 'nullable|string|max:200',
            'city'            => 'nullable|string|max:25',
            'pincode'         => 'nullable|string|max:70',
            'contact_person'  => 'nullable|string|max:80',
            'tel_no'          => 'nullable|string|max:20',
            'email'           => 'nullable|email|max:50',
            'gstin'           => 'nullable|string|max:80',
            'pan_no'          => 'nullable|string|max:50',
            'cin_no'          => 'nullable|string|max:50',
            'credit_days'     => 'nullable|integer|min:0',
            'tds_percent'     => 'nullable|integer|min:0|max:100',
            'status'          => 'required|boolean',
        ]);
        
        $masterForwarder =  new MasterForwarder();
        $masterForwarder->company_id =  Auth::user()->company_id;
        $masterForwarder->uuid = Str::uuid();
        $masterForwarder->party_code = $validated['party_code'];
        $masterForwarder->party_name = $validated['party_name'];

        $masterForwarder->tally_ledger = $validated['tally_ledger'];
        $masterForwarder->address_line1 = $validated['address_line1'];
        $masterForwarder->address_line2 = $validated['address_line2'];
        $masterForwarder->address_line3 = $validated['address_line3'];

        $masterForwarder->city = $validated['city'];
        $masterForwarder->pincode = $validated['pincode'];
        $masterForwarder->contact_person = $validated['contact_person'];

        $masterForwarder->tel_no = $validated['tel_no'];
        $masterForwarder->email = $validated['email'];
        $masterForwarder->gstin = $validated['gstin'];
        $masterForwarder->pan_no = $validated['pan_no'];

        $masterForwarder->cin_no = $validated['cin_no'];
        $masterForwarder->credit_days = $validated['credit_days'];
        $masterForwarder->tds_percent = $validated['tds_percent'];
        $masterForwarder->status = $validated['status'];
        $masterForwarder->user_id = $this->user_id;

        if(!$validated['party_code']){
            $masterForwarder->party_code = '0';
        }

        $masterForwarder->save();

        // return redirect()->back()->with('success', 'Party created successfully.');
        
        return response()->json([
            'success' => true,
            'party' => [
                'id' => $masterForwarder->id,
                'name' => $masterForwarder->party_name,
            ]
        ]);
    }
    
    
    public function CommonPackageForms(Request $request)
    {
        $request->validate([
            'package_code' => 'required|max:25',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $package = new MasterPackage();

        $package->company_id = $this->company_id;
        $package->uuid = Str::uuid();
        
        $package->package_code = $request->package_code;
        $package->description = $request->description;
        $package->status = $request->status;
        $package->user_id = $this->user_id;

        $package->save();

        // return redirect()->back()->with('success', 'Package created successfully.');
        
        return response()->json([
            'success' => true,
            'package' => [
                'id' => $package->id,
                'name' => $package->package_code
            ]
        ]);
        
    }
    
    // public function getJobDetails(Request $request)
    // {
    //     $job_activity = $request->job_activity;
    //     if($job_activity == 'AIRIMP.FWD' || $job_activity == 'SEAIMP.FWD'){
    //         $job = OperationJobMaster::with('consigneeName')->find($request->job_id);
    //         $party_name = $job->consigneeName->party_name;
    //     }else{
    //         $job = OperationJobMaster::with('shipperName')->find($request->job_id);
    //         $party_name = $job->shipperName->party_name;
    //     }
        
    //     if ($job) {
    //         return response()->json([
    //             'id' => $job->id,
    //             'job_party_id' => $job->job_party_id,
    //             'job_party_name' => $party_name,
    //             'jobMasterData' => $job
    //         ]);
    //     } else {
    //         return response()->json(['error' => 'Job not found'], 404);
    //     }
    // }
    
    // mourya // getting the job no whose entry doesn't exists in the bl (alert is not working)
    public function getJobDetails(Request $request)
    {
        $jobId = $request->job_id;  // fix
    
        // Get all job IDs already used in any operation table
        $usedJobIds = collect()
            ->merge(OperationAirExport::pluck('job_no'))
            ->merge(OperationAirImport::pluck('job_no'))
            ->merge(OperationSeaExport::pluck('job_no'))
            ->merge(OperationSeaImport::pluck('job_no'))
            ->unique()
            ->toArray();
    
        // Job is unused only if it is not in usedJobIds
        $job = OperationJobMaster::where('id', $jobId)
                    ->whereNotIn('id', $usedJobIds)
                    ->first();
    
        if (!$job) {
            // RETURN 404 SO AJAX error BLOCK RUNS
            return response()->json(['error' => 'Job already exists'], 404);
        }
    
        // Get party name
        if (in_array($request->job_activity, ['AIRIMP.FWD', 'SEAIMP.FWD'])) {
            $party_name = $job->consigneeName->party_name ?? null;
        } else {
            $party_name = $job->shipperName->party_name ?? null;
        }
    
        return response()->json([
            'id' => $job->id,
            'job_party_id' => $job->job_party_id,
            'job_party_name' => $party_name,
            'jobMasterData' => $job
        ]);
    }

    
    public function addSalesPerson(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:operation_sales_people,name|max:255',
            'email' => 'nullable|email',
            'number' => 'nullable|numeric',
            'designation' => 'nullable|string'
        ]);
    
        try {
            $salesperson = OperationSalesPerson::create([
                'name' => $request->name,
                'email' => $request->email,
                'number' => $request->number,
                'designation' => $request->designation,
                'company_id' => $this->company_id ?? auth()->user()->company_id ?? 1 // fallback
            ]);
    
            return response()->json($salesperson);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function CommonShippingLine(Request $request)
    {
        $validated = $request->validate([
            'shipping_line_code' => 'nullable|string',
            'shipping_line_name' => 'required|string',
            'address_line_1'     => 'required|string',
            'address_line_2'     => 'nullable|string',
            'agent_code'         => 'nullable|string',
            'line_code'          => 'nullable|string',
            'shipping_line_type' => 'required|in:1,2', // 1: Indian, 2: Overseas
            'status'             => 'required|in:1,0',
        ]);
        
        $name_exit = MasterShipping::where('company_id', $this->company_id)->where('shipping_line_name', $request->shipping_line_name)->first();
        // print_r($name_exit);
        // exit();
        if($name_exit){
            return response()->json(['status' => false, 'message' => 'This Shipping Line Name Already Exist.']);
        }

        $shipping = new MasterShipping();

        $shipping->company_id =  Auth::user()->company_id;
        $shipping->uuid = Str::uuid();
        $shipping->shipping_line_code = $request->shipping_line_code;
        $shipping->shipping_line_name = $request->shipping_line_name;
        $shipping->address_line_1 = $request->address_line_1;
        $shipping->address_line_2 = $request->address_line_2;
        $shipping->agent_code = $request->agent_code;
        $shipping->line_code = $request->line_code;
        $shipping->shipping_line_type = $request->shipping_line_type;
        $shipping->status = $request->status;
        $shipping->user_id = $this->user_id;

        $shipping->save();
        
        return response()->json($shipping);
    }
    
    
    public function addChargesName(Request $request)
    {
         $validated = $request->validate([
            'charge_code' => 'required',
            'charge_name' => 'required|unique:master_charges,charge_name',
            'tally_ledger_name' => 'nullable',
            'currency' => 'required',
            'charge_type' => 'required',
            'gst_applicable' => 'required|boolean',
            'gst_percentage' => 'required|integer',
            'has_formula' => 'required|boolean',
            'limit' => 'nullable|numeric',
            'percentage' => 'nullable|numeric',
            'sac_code' => 'nullable',
            'status' => 'required|boolean',
        ]);

        $charge = new MasterCharge();

        $charge->company_id = Auth::user()->company_id;
        $charge->uuid = Str::uuid();
        $charge->charge_code = $request->charge_code;
        $charge->charge_name = $request->charge_name;
        $charge->tally_ledger_name = $request->tally_ledger_name;
        $charge->currency = $request->currency;
        $charge->charge_type = $request->charge_type;
        $charge->gst_applicable = $request->gst_applicable;
        $charge->gst_percentage = $request->gst_percentage;
        $charge->has_formula = $request->has_formula;
        $charge->limit = $request->limit;
        $charge->percentage = $request->percentage;
        $charge->sac_code = $request->sac_code;
        $charge->status = $request->status;
        $charge->user_id = $this->user_id;

        $charge->save();
        
        return response()->json([
            'status' => true,
            'message' => 'Charge name added successfully!',
            'data' => $charge
        ]);
        
    }
    
    public function addBiType(Request $request){
        $validated = $request->validate([
            'bl_description' => 'required',
            'status' => 'required|boolean',
        ]);
        
        $MasterBlType = new MasterBlType();

        $MasterBlType->company_id = Auth::user()->company_id;
        $MasterBlType->uuid = Str::uuid();
        $MasterBlType->bl_description = $request->bl_description;
        $MasterBlType->status = $request->status;
        $MasterBlType->user_id = $this->user_id;
        
        $MasterBlType->save();
        
        return response()->json([
            'success' => true,
            'bltype' => [
                'id' => $MasterBlType->id,
                'name' => $MasterBlType->bl_description
            ]
        ]);
    }
    
    public function newBillingParty(Request $request){
        echo "<pre>"; print_r($request->all()); exit();
    }
    
    public function newPurchaseParty(Request $request)
    {
        $rules = [
            'party_code'      => 'nullable|string|max:255',
            'party_name'      => 'required|string|max:255',
            'address_1'       => 'required|string|max:255',
            'address_2'       => 'nullable|string|max:255',
            'address_3'       => 'nullable|string|max:255',
            'ledger_name'     => 'nullable|string|max:255',
            'city'            => 'nullable|string|max:255',
            'pincode'         => 'nullable|string|max:20',
            'party_type'      => 'required|string|max:100',
            'contact_person'  => 'nullable|string|max:255',
            'tel_no'          => 'nullable|string|max:20',
            'email'           => 'nullable|email|max:255',
            'gstin'           => 'nullable|string|max:20',
            'state_code'           => 'nullable|string|max:50',
            'state'           => 'nullable|string|max:50',
            'pan_no'          => 'nullable|string|max:10',
            'cin_no'          => 'nullable|string|max:21',
            'credit_days'     => 'nullable|integer|min:1',
            'tds_percent'     => 'nullable|integer|min:0|max:100',
            'status'          => 'required|boolean',
        ];
        
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        $validated = $validator->validated();
        
        $masterParty =  new PurchaseParties();
        
        $masterParty->company_id = $this->company_id;
        $masterParty->uuid = Str::uuid();

        $masterParty->party_code = $validated['party_code'];
        $masterParty->party_name = $validated['party_name'];

        $masterParty->address_line1 = $validated['address_1'];
        $masterParty->address_line2 = $validated['address_2'];
     
        $masterParty->city = $validated['city'];
        $masterParty->pincode = $validated['pincode'];
        $masterParty->party_type = $validated['party_type'];
        $masterParty->contact_person = $validated['contact_person'];

        $masterParty->tel_no = $validated['tel_no'];
        $masterParty->email = $validated['email'];
        $masterParty->gstin = $validated['gstin'];
        $masterParty->pan_no = $validated['pan_no'];

        $masterParty->cin_no = $validated['cin_no'];
        $masterParty->credit_days = $validated['credit_days'];
        $masterParty->tds_percent = $validated['tds_percent'];
        $masterParty->state = $validated['state'];
        $masterParty->state_code = $validated['state_code'];
        $masterParty->status = $validated['status'];
        $masterParty->user_id = $this->user_id;

        if(!$validated['party_code']){
            $masterParty->party_code = '0';
        }

        $masterParty->save();
        
        return response()->json([
            'success' => true,
            'party' => [
                'id' => $masterParty->id,
                'name' => $masterParty->party_name,
            ]
        ]);
    }


}
