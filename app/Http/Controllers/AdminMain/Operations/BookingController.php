<?php

namespace App\Http\Controllers\AdminMain\Operations;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MasterImportParty;
use App\Models\MasterPort;
use App\Models\MasterVessel;
use App\Models\MasterParty;
use Illuminate\Support\Facades\Auth;
use App\Models\Operations\OperationBooking;
use Illuminate\Support\Facades\Storage;
use App\Models\Operations\OperationAllFileUpload;

class BookingController extends Controller
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
        $query = OperationBooking::where('company_id', $this->company_id);

        if($request->filled('booking_no')){
            $query->where('booking_no', 'LIKE', '%'.$request->booking_no.'%');
        }
        if($request->filled('cargo_type')){
            $query->orWhere('cargo_type', 'LIKE', '%'.$request->cargo_type.'%');
        }
        if($request->filled('from_date') && $request->filled('to_date')){
            $query->whereBetween('entry_date', [$request->from_date, $request->to_date]);
        }

        $bookingLists = $query->orderBy('created_at', 'desc')->paginate(10);

        $filters = OperationBooking::where('company_id', $this->company_id)->get();     

        return view('admin-main.admin.booking.index', compact('bookingLists', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vessels  = MasterVessel::where('company_id', $this->company_id)->get();
        $parties  = MasterImportParty::where('company_id', $this->company_id)->get();
        $ports  = MasterPort::where('company_id', $this->company_id)->get();
        $party_lists  = MasterParty::where('company_id', $this->company_id)->get();
        $files = OperationAllFileUpload::where('company_id', $this->company_id)->where('file_related', 'booking')->orderBy('created_at', 'desc')->get();


        $operationBookings = OperationBooking::where('company_id', $this->company_id)->get(['id', 'file_name', 'booking_no', 'created_at']);

        $findFiles = $operationBookings->whereNotNull('file_name')->values();
        $booking_nums = $operationBookings->sortByDesc('created_at')->values();
    
        $latestBooking = $operationBookings->sortByDesc('id')->first();
        $nextBookingNo = $latestBooking ? $latestBooking->booking_no + 1 : 1;
    
        return view('admin-main.admin.booking.create', compact('vessels', 'parties', 'ports', 'booking_nums', 'findFiles', 'party_lists', 'nextBookingNo', 'files'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_no' => 'required|string',
            'vessel_id' => 'nullable|exists:master_vessels,id',
            'voy_no' => 'nullable|string',
            'eta_date' => 'nullable|date',
            'entry_date' => 'nullable|date',
            'validity_days' => 'nullable|integer',
            'validity_date' => 'nullable|date',
            'cargo_type' => 'nullable|string',
            'shipment_terms' => 'nullable|string',
            'gate_open' => 'nullable|string',
            'container_volume' => 'nullable|string',
            'plugging' => 'nullable|string',
            'do_cancel' => 'nullable|boolean',
            'cargo_wt' => 'nullable|string',
            'cont_wt' => 'nullable|string',
            'ventilation' => 'nullable|string',
            'temperature' => 'nullable|string',
            'commodity' => 'nullable|string',
            'package' => 'nullable|string',
            'humidity' => 'nullable|string',
            'special_eq_remarks' => 'nullable|string',
            'class' => 'nullable|string',
            'sub_class' => 'nullable|string',
            'shipper_id' => 'nullable|exists:master_import_parties,id',
            'sales_person_id' => 'nullable|exists:master_import_parties,id',
            'empty_yard_id' => 'nullable|exists:master_import_parties,id',
            'surveyor_id' => 'nullable|exists:master_import_parties,id',
            'shipping_line_id' => 'nullable|exists:master_import_parties,id',
            'port_loading_id' => 'nullable|exists:master_ports,id',
            'port_discharge_id' => 'nullable|exists:master_ports,id',
            'port_transhipment_id' => 'nullable|exists:master_ports,id',
            'port_destination_id' => 'nullable|exists:master_ports,id',
            'imo_cd' => 'nullable|string',
            'uno_cd' => 'nullable|string',
            'cancel_remark' => 'nullable|string',
            'special_remark' => 'nullable|string',
            'full_do_no' => 'nullable|string',
            // 'cont_category' => 'nullable|string',
            // 'container_no' => 'nullable|string',
            // 'size' => 'nullable|string',
            // 'customer_seal_no' => 'nullable|string',
            // 'cont_do_no' => 'nullable|string',
            // 'file_name' => 'required|string',
            // 'file_path' => 'nullable|string',
        ]);

        $validated['uuid'] = Str::uuid();
        $validated['company_id'] = $this->company_id;

        $booking  = OperationBooking::create($validated);

        return redirect()->back()->with('success', 'Booking saved successfully.')->with('id', $booking->id);
        
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
        $vessels  = MasterVessel::where('company_id', $this->company_id)->get();
        $parties  = MasterImportParty::where('company_id', $this->company_id)->get();
        $ports  = MasterPort::where('company_id', $this->company_id)->get();

        $bookingList = OperationBooking::where('uuid', $uuid)->firstOrFail();
        return view('admin-main.admin.booking.edit', compact('bookingList', 'vessels', 'parties', 'ports'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $booking  = OperationBooking::findOrFail($id)->delete();

        return response()->json(['success', 'Booking Record deleted successfull']);
    }

    public function addContainer(Request $request){

        if(!$request->filled('booking_id')){
            return response()->json(['error' => 'Please Select First Booking No. !']);
        }

        $booking_record = OperationBooking::findOrFail($request->booking_id);

        $request->validate([
            'container_category' => 'required|string',
            'size' => 'required|string',
            'container_no' => 'required|string|max:50',
            'seal_no' => 'nullable|string|max:50',
            'do_no' => 'nullable|string|max:50',
        ]);

        $booking_record->cont_category = $request->container_category;
        $booking_record->size = $request->size;
        $booking_record->container_no = $request->container_no;
        $booking_record->customer_seal_no = $request->seal_no;
        $booking_record->cont_do_no = $request->do_no;

        $booking_record->save();

        return redirect()->back()->with('success', 'Container added successfully.');
    }

    public function updateContainer(Request $request, int $id){

        $booking_record = OperationBooking::findOrFail($id);

        $request->validate([
            'container_category' => 'required|string',
            'size' => 'required|string',
            'container_no' => 'required|string|max:50',
            'seal_no' => 'nullable|string|max:50',
            'do_no' => 'nullable|string|max:50',
        ]);

        $booking_record->cont_category = $request->container_category;
        $booking_record->size = $request->size;
        $booking_record->container_no = $request->container_no;
        $booking_record->customer_seal_no = $request->seal_no;
        $booking_record->cont_do_no = $request->do_no;

        $booking_record->save();

        return redirect()->back()->with('success', 'Container Updated successfully.');
    }
    
    public function print($id)
    {
        $booking = OperationBooking::with(['vessel', 'party',]) // Add relationships as needed
                          ->findOrFail($id);
    
        return view('admin-main.admin.booking.print', compact('booking'));
    }


}
