<?php

namespace App\Http\Controllers\AdminMain\Operations;

use App\Models\MasterPort;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MasterContainer;
use App\Models\MasterImportParty;
use App\Models\MasterPackage;
use App\Models\MasterParty;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Operations\OperationTransport;
use App\Models\Operations\OperationAllFileUpload;
use App\Models\Operations\OperationSalesPerson;
use App\Models\Operations\TransportContainer;

class TransportController extends Controller
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
        $query = OperationTransport::query();

        $query->where(function($q) {
            $q->where('company_id', $this->company_id);
        });

        if($request->filled('full_job_no')){
            $query->where('full_job_no', 'LIKE', '%' . $request->full_job_no . '%');
        }

        if($request->filled('booking_no')){
            $query->where('booking_no', 'LIKE', '%' . $request->booking_no . '%');
        }

        if($request->filled('shipping_bill_no')){
            $query->where('shipping_bill_no', 'LIKE', '%' . $request->shipping_bill_no . '%');
        }

        $transportDetails = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin-main.admin.transport.index', compact('transportDetails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();
        $ports = MasterPort::where('company_id', $this->company_id)->get();
        $packages = MasterPackage::where('company_id', $this->company_id)->get();
        $con_sizes = MasterContainer::where('company_id', $this->company_id)->get();
        $party_lists  = MasterParty::all();
        $salePersons  = OperationSalesPerson::where('company_id', $this->company_id)->get();

        $files = OperationAllFileUpload::where('company_id', $this->company_id)->where('file_related', 'transport')->orderBy('created_at', 'desc')->get();
        $transports = OperationTransport::select('id')->where('company_id', $this->company_id)->orderBy('created_at', 'desc')->get();

        return view('admin-main.admin.transport.create', compact('salePersons', 'parties', 'ports', 'con_sizes', 'files', 'transports', 'party_lists', 'packages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'from_party_id' => 'required|exists:master_import_parties,id',
            'from_place_id' => 'required|exists:master_ports,id',
            'booking_no' => 'required|string|max:255',
            'booking_date' => 'required|date',
            'pickup_date' => 'nullable|string|max:255',
            'gate_in_date' => 'nullable|string|max:255',
            'sales_person_id' => 'nullable|exists:master_import_parties,id',
            'shipping_bill_no' => 'required|string|max:255',
            'quantity' => 'nullable|string|max:255',
            'gross_weight' => 'nullable|string|max:255',
            'cha_trans_id' => 'nullable|exists:master_import_parties,id',
            'to_place_id' => 'required|exists:master_ports,id',
            'customer_inv_no' => 'required|string|max:255',
            'ccm_date' => 'nullable|date',
            'stuffing_date' => 'nullable|date',
            'port_in_date' => 'nullable|date',
            'transporter_id' => 'nullable|exists:master_import_parties,id',
            'description' => 'nullable|string|max:500',
            'package_id' => 'nullable',
            'remarks' => 'nullable|string|max:500',
            'job_no' => 'nullable|string',
            'full_job_no' => 'nullable|string',
        ]);
    
        $transport = new OperationTransport($validated);
        $transport->company_id = $this->company_id; 
        $transport->user_id = $this->user_id; 
        $transport->uuid = Str::uuid(); 
        $transport->save();
    
        return response()->json([
            'success' => true,
            'transport_id' => $transport->id
        ]);
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
        $trasportDetail = OperationTransport::where('uuid', $uuid)->firstOrFail();
        $packages = MasterPackage::where('company_id', $this->company_id)->get();
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();
        $ports = MasterPort::where('company_id', $this->company_id)->get();
        $con_sizes = MasterContainer::where('company_id', $this->company_id)->get();
        $salePersons  = OperationSalesPerson::where('company_id', $this->company_id)->get();
        $files = OperationAllFileUpload::where('company_id', $this->company_id)->where('file_related', 'transport')->orderBy('created_at', 'desc')->get();
        $party_lists  = MasterParty::all();
        
        $containerDetails = TransportContainer::where('company_id', $this->company_id)
                                            ->where('transport_id', $trasportDetail->id)
                                            ->get();
    
        return view('admin-main.admin.transport.edit', compact('containerDetails', 'party_lists', 'files', 'salePersons', 'trasportDetail', 'parties', 'ports', 'con_sizes', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transport = OperationTransport::findOrFail($id);

        $validated = $request->validate([
            'from_party_id' => 'required|exists:master_import_parties,id',
            'from_place_id' => 'required|exists:master_ports,id',
            'booking_no' => 'required|string|max:255',
            'booking_date' => 'required|date',
            'pickup_date' => 'nullable|string|max:255',
            'gate_in_date' => 'nullable|string|max:255',
            'sales_person_id' => 'nullable|exists:master_import_parties,id',
            'shipping_bill_no' => 'required|string|max:255',
            'quantity' => 'nullable|string|max:255',
            'gross_weight' => 'nullable|string|max:255',
            'cha_trans_id' => 'nullable|exists:master_import_parties,id',
            'to_place_id' => 'required|exists:master_ports,id',
            'customer_inv_no' => 'required|string|max:255',
            'ccm_date' => 'nullable|date',
            'stuffing_date' => 'nullable|date',
            'port_in_date' => 'nullable|date',
            'transporter_id' => 'nullable|exists:master_import_parties,id',
            'description' => 'nullable|string|max:500',
            'package_id' => 'nullable',
            'remarks' => 'nullable|string|max:500',
        ]);
        $validated['user_id'] = $this->user_id;

        $transport->update($validated);

        return redirect()->back()->with('success', 'Transport details updated successully. !');
    }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy(string $id)
    {
        $trasportDetail = OperationTransport::findOrFail($id);
        $trasportDetail->delete();

        return response()->json(['success', 'transport record deleted succesfull ! ']);
    }


    public function addContainer(Request $request)
    {
        if (!$request->filled('transport_id')) {
            return response()->json(['success' => false, 'message' => 'Transport ID missing']);
        }
    
        $validated = $request->validate([
            'transport_id'         => 'required|exists:operation_transports,id',
            'transporter'         => 'nullable|exists:master_import_parties,id',
            'container_no'         => 'required|string|max:100',
            'size'                 => 'required|string|max:50',
            'vehicle_no'           => 'nullable|string|max:40',
            'lr_no'                => 'nullable|string|max:100',
            'tare_weight'          => 'nullable|numeric|min:0',
            'cont_gross_weight'    => 'nullable|numeric|min:0',
            'cvc_plate'            => 'nullable|string|max:255',
            'stuffing_point'       => 'nullable|string|max:50',
            'customer_seal_no'     => 'nullable|string|max:100',
            'agent_seal_no'        => 'nullable|string|max:50',
            'net_weight'           => 'nullable|numeric|min:0',
            'cargo'                => 'nullable|string|max:50',
            'container_job_no'     => 'nullable|string|max:50',
        ]);
    
        $container = new TransportContainer($validated);
        $container->company_id = $this->company_id; 
        $container->uuid = Str::uuid(); 
        $container->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Container saved successfully',
            'container_no' => $container->container_no,
            'container' => $container
        ]);
    }


    public function saveContainer(Request $request)
    {
        $validated = $request->validate([
            'transport_id'       => 'required|exists:operation_transports,id',
            'transporter'        => 'nullable|exists:master_import_parties,id',
            'container_no'       => 'required|string|max:100',
            'size'               => 'required|string|max:50',
            'vehicle_no'         => 'nullable|string|max:40',
            'lr_no'              => 'nullable|string|max:100',
            'tare_weight'        => 'nullable|numeric',
            'cont_gross_weight'  => 'nullable|numeric',
            'cvc_plate'          => 'nullable|string',
            'stuffing_point'     => 'nullable|string',
            'customer_seal_no'   => 'nullable|string',
            'agent_seal_no'      => 'nullable|string',
            'net_weight'         => 'nullable|numeric',
            'cargo'              => 'nullable|string',
            'container_job_no'   => 'nullable|string',
        ]);
    
        $data = $validated;
        $data['company_id'] = $this->company_id;
    
        // Prevent overwriting uuid on update
        if (!$request->container_id) {
            $data['uuid'] = Str::uuid();
        }
    
        $container = TransportContainer::updateOrCreate(
            ['id' => $request->container_id],
            $data
        );
    
        // Reload updated list
        $containerDetails = TransportContainer::where('transport_id', $request->transport_id)->get();
    
        $html = view('admin-main.admin.transport.container_table', compact('containerDetails'))->render();
    
        return response()->json([
            'success' => true,
            'message' => $request->container_id ? 'Container Updated' : 'Container Added',
            'html' => $html
        ]);
    }

    public function deleteContainer($id)
    {
        $container = TransportContainer::find($id);
    
        if (!$container) {
            return response()->json([
                'success' => false,
                'message' => 'Container not found'
            ]);
        }
    
        $container->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Container deleted successfully'
        ]);
    }


    // mourya    
    public function getContainer($id)
    {
        $container = TransportContainer::findOrFail($id);
    
        return response()->json([
            'success' => true,
            'container' => $container
        ]);
    }


}
