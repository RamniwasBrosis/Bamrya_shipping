<?php

namespace App\Http\Controllers\AdminMain\Operations;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Operations\OperationJobMaster;
use App\Models\Operations\OperationAirExport;
use App\Models\Operations\OperationAirImport;
use App\Models\Operations\OperationSeaExport;
use App\Models\Operations\OperationSeaImport;

use App\Models\User;
use App\Notifications\JobStatusChangedNotification;
use Illuminate\Support\Facades\Notification;

class JobOpenCloseController extends Controller
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
        return view('admin-main.admin.jobOpenClose.create');
    }
    
    public function fetchData(Request $request)
    {
        // Default value = Air Import (AI)
        $searchBy = $request->input('search_by', 'AIRIMP.FWD');
    
        // Job type ke hisab se data laa rahe hain
        $jobs = OperationJobmaster::with(['consigneeName', 'shipperName'])->where('company_id', $this->company_id)
            ->where('job_activity', $searchBy)
            ->orderBy('job_date', 'desc')
            ->orderBy('job_status', 'asc')
            ->get(['id', 'job_no', 'full_job_no', 'job_party_id', 'job_date', 'job_status']);
    
        $html = '';
    
        if ($jobs->isEmpty()) {
            $html .= '<tr><td colspan="6" class="text-center text-muted">No records found.</td></tr>';
        } else {
            
            foreach ($jobs as $job) {
                
    
                switch($searchBy){
                
                    case 'AIRIMP.FWD' :
                    $activity = 'AI';
                    $party_name = $job->consigneeName->party_name??'';
                    break;
                    
                    case 'AIREXP.FWD':
                    $activity = 'AE';
                    $party_name = $job->shipperName->party_name??'';
                    break;
                    
                    case 'SEAIMP.FWD':
                    $activity = 'SI';
                    $party_name = $job->consigneeName->party_name??'';
                    break;
            
                    case 'SEAEXP.FWD':
                    $activity = 'SE';
                    $party_name = $job->shipperName->party_name??'';
                    break;
            
                    default:
                    $activity = 'AI'; 
                    $party_name = $job->consigneeName->party_name??'';
                    break;
                }
            
                $html .= '
                    <tr>
                        <td><input type="checkbox" name="job_ids[]" value="' . $job->id . '"></td>
                        <td>' . $job->full_job_no . '</td>
                        <td>' . ($party_name ?? '-') . '</td>
                        <td>' . \Carbon\Carbon::parse($job->job_date)->format('d-m-Y') . '</td>
                        <td>' . $activity . '</td>
                        <td>' . ($job->job_status == "O" ? "Open" : "Close") . '</td>
                    </tr>';
            }
        }
    
        return response()->json(['html' => $html, 'jobs' => $jobs]);
    }
    
    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'job_ids' => 'required|array',
            'job_status' => 'required|in:O,C',
        ]);
    
        // OperationJobmaster::whereIn('id', $request->job_ids)
        //     ->update(['job_status' => $request->job_status]);
        
        $jobs = OperationJobmaster::whereIn('id', $request->job_ids)->where('company_id', $this->company_id)->get();

        foreach ($jobs as $job) {
            
            $job->update(['job_status' => $request->job_status]);
            $job->update(['user_id' => $this->user_id]);
            
            if ($job->bl_type_prefix == 'AI') {

                $airImport = OperationAirExport::where('company_id', $this->company_id)
                    ->where('job_no', $job->id)
                    ->first();
            
                if ($airImport) {
                    $airImport->update([
                        'operation_complate' => $request->job_status == 'C' ? 1 : null
                    ]);
                }
            
            } elseif ($job->bl_type_prefix == 'AE') {
            
                $airExport = OperationAirImport::where('company_id', $this->company_id)
                    ->where('job_no', $job->id)
                    ->first();
                    
            
                if ($airExport) {
                    $airExport->update([
                        'operation_complate' => $request->job_status == 'C' ? 1 : null
                    ]);
                }
            
            } elseif ($job->bl_type_prefix == 'SI') {
            
                $seaImport = OperationSeaImport::where('company_id', $this->company_id)
                    ->where('job_no', $job->id)
                    ->first();
                
                if ($seaImport) {
                    $seaImport->update([
                        'operation_complate' => $request->job_status == 'C' ? 1 : null
                    ]);
                }
            
            } elseif ($job->bl_type_prefix == 'SE') {
            
                $seaExport = OperationSeaExport::where('company_id', $this->company_id)
                    ->where('job_no', $job->id)
                    ->first();
                    
                if ($seaExport) {
                    $seaExport->update([
                        'operation_complate' => $request->job_status == 'C' ? 1 : null
                    ]);
                }
            }

            
            
    
            // Notify all Admins
            $admins = User::where('role', 'super-admin')->where('company_id', $this->company_id)->get();
            Notification::send($admins, new JobStatusChangedNotification($job, $request->job_status, auth()->user()));
        }
    
        return redirect()->back()->with('success', 'Selected jobs updated successfully.');
    }
    
    public function filter(Request $request)
    {
        $query = OperationJobmaster::with(['shipperName', 'consigneeName'])->where('company_id', $this->company_id);
        if ($request->filled('job_no')) {
            $query->where('job_no', $request->job_no);
        }
        if ($request->filled('job_party_id')) {
            $query->where('party_id', $request->job_party_id);
        }
    
        $jobs = $query->get();

        // Generate HTML for table body
        $html = '';
        if ($jobs->count() > 0) {
            foreach ($jobs as $job) {
                
                switch($job->job_activity){
                
                    case 'AIRIMP.FWD' :
                    $activity = 'AI';
                    $party_name = $job->consigneeName->party_name;
                    break;
                    
                    case 'AIREXP.FWD':
                    $activity = 'AE';
                    $party_name = $job->shipperName->party_name;
                    break;
                    
                    case 'SEAIMP.FWD':
                    $activity = 'SI';
                    $party_name = $job->consigneeName->party_name;
                    break;
            
                    case 'SEAEXP.FWD':
                    $activity = 'SE';
                    $party_name = $job->shipperName->party_name;
                    break;
            
                    default:
                    $activity = 'AI'; 
                    $party_name = $job->consigneeName->party_name;
                    break;
                }
                
                
                
                $html .= '<tr>';
                $html .= '<td><input type="checkbox" name="job_ids[]" value="' . $job->id . '"></td>';
                $html .= '<td>' . $job->job_no . '</td>';
                $html .= '<td>' . $party_name . '</td>';
                $html .= '<td>' . ($job->job_date ?? '-') . '</td>';
                $html .= '<td>' . $activity . '</td>';
                $html .= '<td>' . ($job->job_status == "O" ? "Open" : "Close") . '</td>';
                $html .= '</tr>';
            }
        } else {
            $html = '<tr><td colspan="6" class="text-center text-muted">No matching records found</td></tr>';
        }
    
        return response()->json([
            'status' => 'success',
            'html' => $html
        ]);
    }



    public function store(Request $request)
    {

        $query = OperationJobMaster::where('company_id', $this->company_id);

        switch ($request->search_by) {
            case 'AE':
                $query->where('job_activity', 'AIREXP.FWD')->where('job_status', 'O');
                break;
            case 'SI':
                $query->where('job_activity', 'SEAIMP.FWD')->where('job_status', 'O');
                break;
            case 'SE':
                $query->where('job_activity', 'SEAEXP.FWD')->where('job_status', 'O');
                break;
            default:
                $query->where('job_activity', 'AIRIMP.FWD')->where('job_status', 'O');
                break;
        }
        $job_masters = $query->orderBy('created_at', 'desc')->paginate(25);

        $html = '';
        $FullJobNum = '<option value="">select</option>';
        $partyName = '<option value="">select</option>';

        foreach ($job_masters as $job_master) {

            switch ($job_master->job_activity) {
                case 'AIREXP.FWD':
                    $job_num = 'AE/'.$job_master->job_no.'/'.$job_master->created_at->format('Y');
                    $activity = 'AE';
                    break;
                case 'SEAIMP.FWD':
                    $job_num = 'SI/'.$job_master->job_no.'/'.$job_master->created_at->format('Y');
                    $activity = 'SI';
                    break;
                case 'SEAEXP.FWD':
                    $job_num = 'SE/'.$job_master->job_no.'/'.$job_master->created_at->format('Y');
                    $activity = 'SE';
                    break;                
                default:
                    $job_num = 'AI/'.$job_master->job_no.'/'.$job_master->created_at->format('Y');
                    $activity = 'AI';
                    break;
            }


            $html .= '<tr>
                <td><input type="checkbox" name="selected_jobs[]" value="'. $job_master->id.'"></td>
                <td>'.$job_num .'</td>
                <td>'.$job_master->job_party->party_name .'</td>
                <td>'.$job_master->created_at->format('Y-m-d') .'</td>
                <td>'.$activity .'</td>
                <td>'.($job_master->job_status == 'O' ? 'Open' : 'Close') .'</td>
            </tr>';

            $FullJobNum .= '<option value="'.$job_master->job_no.'">'.$job_num.'</option>';
            $partyName .= '<option value="'.$job_master->job_party->id.'">'.$job_master->job_party->party_name.'</option>';
        }

        

        return response()->json([
            'status' => 'success',
            'result' => $html,
            'full_job_nums' => $FullJobNum,
            'party_name' => $partyName,
        ]);
    }

    public function create()
    {
        // this method use for show Close Jobs table
        
        $close_jobs = OperationJobMaster::where('company_id', $this->company_id)->where('job_status', 'C')->get();
        
        $results = [];
        $html = '';
        
        foreach ($close_jobs as $close_job) {

            switch ($close_job->job_activity) {
                case 'AIREXP.FWD':
                    $job_num = 'AE/'.$close_job->job_no.'/'.$close_job->created_at->format('Y');
                    $activity = 'AE';
                    break;
                case 'SEAIMP.FWD':
                    $job_num = 'SI/'.$close_job->job_no.'/'.$close_job->created_at->format('Y');
                    $activity = 'SI';
                    break;
                case 'SEAEXP.FWD':
                    $job_num = 'SE/'.$close_job->job_no.'/'.$close_job->created_at->format('Y');
                    $activity = 'SE';
                    break;                
                default:
                    $job_num = 'AI/'.$close_job->job_no.'/'.$close_job->created_at->format('Y');
                    $activity = 'AI';
                    break;
            }


            $html .= '<tr>
                <td><input type="checkbox" name="selected_jobs[]" value="'. $close_job->id.'"></td>
                <td>'.$job_num .'</td>
                <td>'.$close_job->job_party->party_name .'</td>
                <td>'.$close_job->created_at->format('Y-m-d') .'</td>
                <td>'.$activity .'</td>
                <td>'.($close_job->job_status == 'O' ? 'Open' : 'Close') .'</td>
            </tr>';
        }

        

        $results[] = [
            'status' => 'success',
            'result' => $html,
        ];
        
        
        return view('admin-main.admin.jobOpenClose.index', compact('results'));
    }


}
