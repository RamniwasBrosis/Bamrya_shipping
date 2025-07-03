<?php

namespace App\Http\Controllers\AdminMain\Operations;

use Illuminate\Http\Request;
use App\Models\MasterImportParty;
use App\Models\MasterParty;
use App\Http\Controllers\Controller;
use App\Models\Operations\OperationJobMaster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use Illuminate\Validation\ValidationException;

class JobMasterController extends Controller
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
        $query = OperationJobMaster::query();

        // Filter by job date
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('job_date', [$request->start_date, $request->end_date]);
        }

        // Filter by booking date
        if ($request->filled('booking_start_date') && $request->filled('booking_end_date')) {
            $query->whereBetween('booking_date', [$request->booking_start_date, $request->booking_end_date]);
        }

        // Filter by job activity
        if ($request->filled('job_activity')) {
            $query->where('job_activity', 'LIKE', '%' . $request->job_activity . '%');
        }

        // Always restrict to current company
        $query->where('company_id', $this->company_id);

        $job_masters = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin-main.admin.jobMaster.index', compact('job_masters'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();
        $party_lists  = MasterParty::all();
        return view('admin-main.admin.jobMaster.create', compact('parties', 'party_lists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'bl_issue'               => 'required|in:Nominated,Enquiry',
            'job_date'               => 'required|date',
            'job_activity'           => 'required|string|max:50',
            'job_party_id'           => 'nullable|exists:master_import_parties,id',
            'job_remarks'            => 'nullable|string|max:500',
            'term'                   => 'nullable|string|max:10',
            'enquiry_reference_no'   => 'nullable|string|max:50',
            'job_activity_type'      => 'required|in:1,2',
            'shipment_type'          => 'required|in:FCL,LCL,AIR',
            'job_status'             => 'required|in:O,C',
            'insurance'              => 'required|in:Y,N',
            'clearance'              => 'required|in:Y,N',
            'transportation'         => 'required|in:Y,N',
            'booking_date'           => 'nullable|date',
            'cargo_ready_date'       => 'nullable|date',
            'pickup_date'            => 'nullable|date',
        ]);

        $lastJob = OperationJobMaster::where('company_id', $this->company_id)->orderBy('job_no', 'desc')->first();
        
        $nextJobNo = $lastJob ? $lastJob->job_no + 1 : 2000;
        
        if($nextJobNo == null || empty($nextJobNo)){
            $nextJobNo = 1 ;
        }
        
        $jobMaster = new OperationJobMaster();

        $jobMaster->company_id = Auth::user()->company_id;

        $jobMaster->issued_by = $request->bl_issue;
        $jobMaster->job_no = $nextJobNo; 
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


        $jobMaster->save();

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
        $jobMaster = OperationJobMaster::findOrFail($id);
        $parties = MasterImportParty::where('company_id', $this->company_id)->get();
        return view('admin-main.admin.jobMaster.edit', compact('jobMaster', 'parties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validated = $request->validate([
                'bl_issue'               => 'required|in:Nominated,Enquiry',
                'job_date'               => 'required|date',
                'job_activity'           => 'required|string|max:50',
                'job_party_id'           => 'nullable|exists:master_import_parties,id',
                'job_remarks'            => 'nullable|string|max:500',
                'term'                   => 'nullable|string|max:10',
                'enquiry_reference_no'   => 'nullable|string|max:50',
                'job_activity_type'      => 'required|in:1,2',
                'shipment_type'          => 'required|in:FCL,LCL,AIR',
                'job_status'             => 'required|in:O,C',
                'insurance'              => 'required|in:Y,N',
                'clearance'              => 'required|in:Y,N',
                'transportation'         => 'required|in:Y,N',
                'booking_date'           => 'nullable|date',
                'cargo_ready_date'       => 'nullable|date',
                'pickup_date'            => 'nullable|date',
            ]);
        } catch (ValidationException $e) {
            dd($e->validator->errors()); // This will show you exactly what's failing
        }

        $jobMaster =  OperationJobMaster::findOrFail($id);

        $jobMaster->issued_by = $request->bl_issue;
        $jobMaster->job_no = $request->job_no; 
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


        $jobMaster->save();

        return redirect()->back()->with('success', 'Job Master updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobMaster =  OperationJobMaster::findOrFail($id);
        $jobMaster->delete();

        return response()->json(['success' => 'job record deleted successfull']);
    }
}
