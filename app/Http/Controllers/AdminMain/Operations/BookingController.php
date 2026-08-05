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
use App\Models\Operations\OperationBookingContainer;
use Illuminate\Support\Facades\Storage;
use App\Models\Operations\OperationBookingFileUploads;
use App\Models\Operations\OperationSalesPerson;
use App\Models\MasterShipping;
use App\Models\MasterExportParty;

class BookingController extends Controller
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
        $party_lists  = MasterParty::whereNotIn('party_type', [9, 6, 8])->get();
        $files = OperationBookingFileUploads::where('company_id', $this->company_id)->get();


        $operationBookings = OperationBooking::where('company_id', $this->company_id)->get(['id', 'file_name', 'booking_no', 'created_at']);

        $findFiles = $operationBookings->whereNotNull('file_name')->values();
        $booking_nums = $operationBookings->sortByDesc('created_at')->values();

        $latestBooking = $operationBookings->sortByDesc('id')->first();
        // $nextBookingNo = $latestBooking ? $latestBooking->booking_no + 1 : 1;

        $salePersons  = OperationSalesPerson::where('company_id', $this->company_id)->get();
        $shippingLines = MasterShipping::where('company_id', $this->company_id)->get();
        $exportParites = MasterExportParty::where('company_id', $this->company_id)->get();
        $partyTypes = MasterParty::whereNotIn('party_type', [9, 6, 8])->get();
        return view('admin-main.admin.booking.create', compact('partyTypes', 'exportParites', 'shippingLines', 'vessels', 'parties', 'ports', 'booking_nums', 'findFiles', 'party_lists', 'files', 'salePersons')); //nextBookingNo
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
            'shipper_id' => 'nullable|exists:master_export_parties,id',
            'sales_person_id' => 'nullable',
            'empty_yard_id' => 'nullable|exists:master_import_parties,id',
            'surveyor_id' => 'nullable|exists:master_import_parties,id',
            'shipping_line_id' => 'nullable|exists:master_shippings,id',
            'port_loading_id' => 'nullable|exists:master_ports,id',
            'port_discharge_id' => 'nullable|exists:master_ports,id',
            'port_transhipment_id' => 'nullable|exists:master_ports,id',
            'port_destination_id' => 'nullable|exists:master_ports,id',
            'imo_cd' => 'nullable|string',
            'uno_cd' => 'nullable|string',
            'cancel_remark' => 'nullable|string',
            'special_remark' => 'nullable|string',
            'full_do_no' => 'nullable|string',
        ]);

        $validated['uuid'] = Str::uuid();
        $validated['company_id'] = $this->company_id;
        $validated['branch_id'] = Auth::user()->branch_id;
        $validated['user_id'] = $this->user_id;

        $booking = OperationBooking::create($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'booking_id' => $booking->id,
                'booking_no' => $booking->booking_no,
                'message' => 'Booking saved successfully!'
            ]);
        }

        return redirect()->back()->with('success', 'Booking saved successfully.');
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

        $salePersons  = OperationSalesPerson::where('company_id', $this->company_id)->get();
        $bookingList = OperationBooking::with('containers')
                            ->where('uuid', $uuid)
                            ->firstOrFail();

        $party_lists  = MasterParty::whereNotIn('party_type', [9, 6, 8])->get();
        $shippingLines = MasterShipping::where('company_id', $this->company_id)->get();
        $exportParites = MasterExportParty::where('company_id', $this->company_id)->get();
        $partyTypes = MasterParty::whereNotIn('party_type', [9, 6, 8])->get();
        $files = OperationBookingFileUploads::where('booking_no', $bookingList->id)->get();

        return view('admin-main.admin.booking.edit', compact('partyTypes', 'exportParites', 'shippingLines', 'bookingList', 'vessels', 'parties', 'ports', 'salePersons', 'files', 'party_lists'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $booking = OperationBooking::findOrFail($id);

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
            'shipper_id' => 'nullable|exists:master_export_parties,id',
            'sales_person_id' => 'nullable',
            'empty_yard_id' => 'nullable|exists:master_import_parties,id',
            'surveyor_id' => 'nullable|exists:master_import_parties,id',
            'shipping_line_id' => 'nullable|exists:master_shippings,id',
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
        $validated['user_id'] = $this->user_id;
        $validated['branch_id'] = Auth::user()->branch_id;

        $booking->update($validated);

        return redirect()->back()->with('success', 'Booking saved successfully.')->with('id', $booking->id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $booking  = OperationBooking::findOrFail($id)->delete();

        return response()->json(['success', 'Booking Record deleted successfull']);
    }

    public function addContainer(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => 'required|exists:master_import_parties,id',
            'container_category' => 'required|string',
            'size' => 'required|string',
            'container_no' => 'required|string|max:50',
            'seal_no' => 'nullable|string|max:50',
            'do_no' => 'nullable|string|max:50',
        ]);

        $validated['company_id'] = $this->company_id;
        $validated['uuid'] = Str::uuid();

        $booking_record = OperationBookingContainer::create([
            'uuid' => $validated['uuid'],
            'company_id' => $validated['company_id'],
            'booking_id' => $validated['booking_id'],
            'container_category' => $validated['container_category'],
            'size' => $validated['size'],
            'container_no' => $validated['container_no'],
            'seal_no' => $validated['seal_no'] ?? null,
            'do_no' => $validated['do_no'] ?? null,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Container added successfully.',
            'data' => $booking_record
        ]);
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

    public function updateFileUpload(Request $request)
    {
        //  Validate request
        $validated = $request->validate([
            'booking_no' => 'required|string',
            'file.*' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx,xlsx,xls,txt,zip|max:10240', // up to 10MB
        ]);

        //  Add uuid and company_id
        $validated['uuid'] = Str::uuid();
        $validated['company_id'] = $this->company_id;

        //  Check if files exist
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                // Generate unique filename
                $fileName = time() . '_' . $file->getClientOriginalName();

                // Store file in 'public/uploads/bookings'
                $filePath = $file->storeAs('public/uploads/bookings', $fileName);

                // Save record in database
                OperationBookingFileUploads::create([
                    'company_id' => $validated['company_id'],
                    'uuid'       => $validated['uuid'],
                    'booking_no' => $validated['booking_no'],
                    'file_name'  => $fileName,
                    'file_path'  => $filePath,
                ]);
            }

            return back()->with('success', 'Files uploaded successfully!');
        }

        return back()->with('error', 'No files selected!');
    }

    public function saveContainer(Request $request)
    {
        $request->validate([
            'container_category' => 'required|string',
            'size'               => 'required|string',
            'container_no'       => 'required|string|max:50',
            'seal_no'            => 'nullable|string|max:50',
            'do_no'              => 'nullable|string|max:50',
            'booking_id'         => 'required|exists:operation_bookings,id',
            'container_id'       => 'nullable|exists:operation_booking_containers,id',
        ]);

        if ($request->container_id) {
            // UPDATE
            $container = OperationBookingContainer::findOrFail($request->container_id);
            $container->update($request->only([
                'container_category', 'size', 'container_no', 'seal_no', 'do_no'
            ]));

            return response()->json(['success' => true, 'type' => 'update']);
        }
        else {
            // CREATE
            $container = OperationBookingContainer::create([
                'uuid'               => Str::uuid(),
                'company_id'         => $this->company_id,
                'booking_id'         => $request->booking_id,
                'container_category' => $request->container_category,
                'size'               => $request->size,
                'container_no'       => $request->container_no,
                'seal_no'            => $request->seal_no,
                'do_no'              => $request->do_no,
            ]);

            return response()->json(['success' => true, 'type' => 'create', 'data' => $container]);
        }
    }

    public function getContainer($id)
    {
        $container = OperationBookingContainer::findOrFail($id);
        return response()->json($container);
    }

    public function deleteContainer($id)
    {
        OperationBookingContainer::findOrFail($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Container deleted successfully.'
        ]);
    }

    public function listContainers($booking_id)
    {
        $containers = OperationBookingContainer::where('booking_id', $booking_id)->get();

        // return only the table rows
        $html = '';

        foreach ($containers as $c) {
            $html .= '
                <tr id="row_'.$c->id.'">
                    <td>'.$c->container_category.'</td>
                    <td>'.$c->size.'</td>
                    <td>'.$c->container_no.'</td>
                    <td>'.$c->seal_no.'</td>
                    <td>'.$c->do_no.'</td>
                    <td>
                        <button class="btn btn-warning btn-sm editBtn" data-id="'.$c->id.'">Edit</button>
                        <button class="btn btn-danger btn-sm deleteBtn" data-id="'.$c->id.'">Delete</button>
                    </td>
                </tr>
            ';
        }

        return $html;
    }


}
