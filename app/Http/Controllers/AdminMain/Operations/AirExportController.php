<?php

namespace App\Http\Controllers\AdminMain\Operations;

use App\Models\MasterPort;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MasterImportParty;
use App\Http\Controllers\Controller;
use App\Models\MasterParty;
use App\Models\MasterPackage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Operations\OperationAirExport;
use App\Models\Operations\OperationJobMaster;
use App\Models\Operations\OperationAllFileUpload;

class AirExportController extends Controller
{

    public $company_id ;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->company_id = Auth::user()->company_id;
            return $next($request);
        });
    }

    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = OperationAirExport::where('company_id', $this->company_id);

        $query->when($request->filled('booking_no'), function ($q) use ($request) {
            $q->where('booking_no', 'LIKE', '%' . $request->booking_no . '%');
        });

        $query->when($request->filled('full_job_no'), function ($q) use ($request) {
            $q->where('full_job_no', 'LIKE', '%' . $request->full_job_no . '%');
        });

        $query->when($request->filled('hawb_no'), function ($q) use ($request) {
            $q->where('hawb_no', 'LIKE', '%' . $request->hawb_no . '%');
        });

        $query->when($request->filled('mawb_no'), function ($q) use ($request) {
            $q->where('mawb_no', 'LIKE', '%' . $request->mawb_no . '%');
        });

        $air_exports = $query->orderBy('created_at', 'desc')->paginate(10);

        $filter_records = OperationAirExport::where('company_id', $this->company_id)->orderBy('created_at', 'desc')->get();
        return view('admin-main.admin.airExport.index', compact('air_exports', 'filter_records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ports = MasterPort::where('company_id', $this->company_id)->get();
        $packages = MasterPackage::where('company_id', $this->company_id)->get();
        $job_numbers = OperationJobMaster::where('company_id', $this->company_id)->orderBy('created_at', 'desc')->get();
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();
        $party_lists  = MasterParty::all();

        $files = OperationAllFileUpload::where('company_id', $this->company_id)->where('file_related', 'air_export')->orderBy('created_at', 'desc')->get();
        
        return view('admin-main.admin.airExport.create', compact('ports', 'job_numbers', 'parties', 'files', 'party_lists', 'packages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'job_no' => 'nullable|integer',
            'full_job_no' => 'nullable|string',
            'booking_no' => 'nullable|string|max:15',
            'booking_date' => 'nullable|date',
            'mawb_no' => 'nullable|string',
            'hawb_no' => 'nullable|string',
            'eta_date' => 'nullable|date',
            'etd_date' => 'nullable|date',
            'enquiry_reference_no' => 'nullable|string',
            'flight_name_1' => 'nullable|string',
            'flight_date_1' => 'nullable|date',
            'flight_number_1' => 'nullable|string',
            'flight_name_2' => 'nullable|string',
            'flight_date_2' => 'nullable|date',
            'flight_number_2' => 'nullable|string',
            'gross_weight' => 'nullable|numeric',
            'chargable_weight' => 'nullable|numeric',
            'tare_weight' => 'nullable|numeric',
            'issue_place' => 'nullable|string',
            'movement' => 'nullable|string',
            'iata_agent' => 'nullable|string',
            'package_qty' => 'nullable|integer',
            'package_id' => 'nullable|integer',
            'customer_acc_no' => 'nullable|string',
            'issue_date' => 'nullable|date',
            'sales_person_id' => 'nullable|integer',

            'shipper_id' => 'nullable|integer',
            'consignee_id' => 'nullable|integer',
            'lata_agent' => 'nullable|integer',
            'overSeas_agent' => 'nullable|integer',

            'loading_port_id' => 'nullable|integer|exists:master_ports,id',
            'discharge_port_id' => 'nullable|integer',
            'receipt_port_id' => 'nullable|integer',
            'delivery_port_id' => 'nullable|integer',

            'insurance' => 'nullable|string',
            'fpa_amount' => 'nullable|numeric',
            'transportation' => 'nullable|string',
            'transportation_details' => 'nullable|string',
            'clearance' => 'nullable|string',
            'shipping_bill' => 'nullable|string',
            'mark_number' => 'nullable|string',
            'goods_description' => 'nullable|string',
            'handling_information' => 'nullable|string',
            'dimention' => 'nullable|string',
        ]);

        $data['company_id'] = $this->company_id;
        $data['uuid'] = Str::uuid();
        
        OperationAirExport::create($data);
        return redirect()->back()->with('success', 'Air import record created successfully.');
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
    public function edit(string $uuid)
    {
        $air_export = OperationAirExport::where('uuid', $uuid)->firstOrFail();

        $ports = MasterPort::where('company_id', $this->company_id)->get();
        $packages = MasterPackage::where('company_id', $this->company_id)->get();
        $job_numbers = OperationJobMaster::where('company_id', $this->company_id)->orderBy('created_at', 'desc')->get();
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();
        $files = OperationAllFileUpload::where('company_id', $this->company_id)->where('file_related', 'air_export')->orderBy('created_at', 'desc')->get();

        return view('admin-main.admin.airExport.edit', compact('air_export', 'ports', 'job_numbers', 'parties', 'files', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      
        $air_export = OperationAirExport::findOrFail($id);

        $data = $request->validate([
            'job_no' => 'nullable|integer',
            'full_job_no' => 'nullable|string',
            'booking_no' => 'nullable|string|max:15',
            'booking_date' => 'nullable|date',
            'mawb_no' => 'nullable|string',
            'hawb_no' => 'nullable|string',
            'eta_date' => 'nullable|date',
            'etd_date' => 'nullable|date',
            'enquiry_reference_no' => 'nullable|string',
            'flight_name_1' => 'nullable|string',
            'flight_date_1' => 'nullable|date',
            'flight_number_1' => 'nullable|string',
            'flight_name_2' => 'nullable|string',
            'flight_date_2' => 'nullable|date',
            'flight_number_2' => 'nullable|string',
            'gross_weight' => 'nullable|numeric',
            'chargable_weight' => 'nullable|numeric',
            'tare_weight' => 'nullable|numeric',
            'issue_place' => 'nullable|string',
            'movement' => 'nullable|string',
            'iata_agent' => 'nullable|string',
            'package_qty' => 'nullable|integer',
            'package_id' => 'nullable|integer',
            'customer_acc_no' => 'nullable|string',
            'issue_date' => 'nullable|date',
            'sales_person_id' => 'nullable|integer',

            'shipper_id' => 'nullable|integer',
            'consignee_id' => 'nullable|integer',
            'lata_agent' => 'nullable|integer',
            'overSeas_agent' => 'nullable|integer',

            'loading_port_id' => 'nullable|integer|exists:master_ports,id',
            'discharge_port_id' => 'nullable|integer',
            'receipt_port_id' => 'nullable|integer',
            'delivery_port_id' => 'nullable|integer',

            'insurance' => 'nullable|string',
            'fpa_amount' => 'nullable|numeric',
            'transportation' => 'nullable|string',
            'transportation_details' => 'nullable|string',
            'clearance' => 'nullable|string',
            'shipping_bill' => 'nullable|string',
            'mark_number' => 'nullable|string',
            'goods_description' => 'nullable|string',
            'handling_information' => 'nullable|string',
            'dimention' => 'nullable|string',
        ]);

        $air_export->update($data);

        return redirect()->back()->with('success', 'Air Export Record Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = OperationAirExport::findOrFail($id);
        $delete->delete();

        return response()->json(['success' => 'Air Export record deleted successfully']);
    }

}
