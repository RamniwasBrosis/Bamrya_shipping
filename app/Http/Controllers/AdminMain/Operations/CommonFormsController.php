<?php

namespace App\Http\Controllers\AdminMain\Operations;

use App\Models\MasterPort;
use Illuminate\Support\Str;
use App\Models\MasterVessel;
use App\Models\MasterPackage;
use App\Models\Operations\OperationJobMaster;
use Illuminate\Http\Request;
use App\Models\MasterImportParty;
use App\Models\Operations\OperationSalesPerson;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommonFormsController extends Controller
{
    public $company_id ;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->company_id = Auth::user()->company_id;
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
        $vessel->uuid = Str::uuid();

        $vessel->save();

        return redirect()->back()->with('success', 'Add a new vessels entry. !');
    }

    public function CommonPortForms(Request $request){
        $validated = $request->validate([
            'port_code' => 'required|string|max:255',
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

        $port->save();       

        return redirect()->back()->with('success', 'Port entry create successfully.');
    }

    public function CommonPartyForms(Request $request){
  
        $validated = $request->validate([
            'party_code'      => 'nullable|string|max:255',
            'party_name'      => 'required|string|max:255',
            'address_1'   => 'nullable|string|max:255',
            'address_2'   => 'nullable|string|max:255',
            'address_3'   => 'nullable|string|max:255',
            'city'            => 'nullable|string|max:255',
            'pincode'         => 'nullable|string|max:20',
            'party_type'      => 'nullable|string|max:100',
            'contact_person'  => 'nullable|string|max:255',
            'tel_no'          => 'nullable|string|max:20',
            'email'           => 'nullable|email|max:255',
            'gstin'           => 'nullable|string|max:20',
            'pan_no'          => 'nullable|string|max:10',
            'cin_no'          => 'nullable|string|max:21',
            'credit_days'     => 'nullable|integer|min:1',
            'tds_percent'     => 'nullable|integer|min:0|max:100',
            'status'          => 'required|boolean',
        ]);
        
        

        $masterParty =  new MasterImportParty();
        $masterParty->company_id = $this->company_id;
        $masterParty->uuid = Str::uuid();

        $masterParty->party_code = $validated['party_code'];
        $masterParty->party_name = $validated['party_name'];

        $masterParty->address_line1 = $validated['address_1'];
        $masterParty->address_line2 = $validated['address_2'];
        $masterParty->address_line3 = $validated['address_3'];

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
        $masterParty->status = $validated['status'];

        if(!$validated['party_code']){
            $masterParty->party_code = '0';
        }
        if($request->filled('ledger_name')){
            $masterParty->tally_ledger = $request->ledger_name;
        }

        $masterParty->save();

        return redirect()->back()->with('success', 'Party created successfully.');
    }
    
    
    public function CommonPackageForms(Request $request){
        $request->validate([
            'package_code' => 'required|max:6|',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $package = new MasterPackage();

        $package->company_id = $this->company_id;
        $package->uuid = Str::uuid();
        
        $package->package_code = $request->package_code;
        $package->description = $request->description;
        $package->status = $request->status;

        $package->save();

        return redirect()->back()->with('success', 'Package created successfully.');
        
    }
    
    public function getJobDetails(Request $request)
    {
        $job = OperationJobMaster::with('job_party')->find($request->job_id);
     
        $party_name = $job->job_party->party_name;
    
        if ($job) {
            return response()->json([
                'id' => $job->id,
                'job_party_id' => $job->job_party_id,
                'job_party_name' => $party_name,
            ]);
        } else {
            return response()->json(['error' => 'Job not found'], 404);
        }
    }
    

    public function addSalesPerson(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
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


}
