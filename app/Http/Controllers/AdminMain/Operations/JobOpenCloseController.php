<?php

namespace App\Http\Controllers\AdminMain\Operations;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Operations\OperationJobMaster;

class JobOpenCloseController extends Controller
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
        return view('admin-main.admin.jobOpenClose.create');
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

    public function destroy(string $id)
    {
        //
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'selected_jobs' => 'required|array',
            'job_status' => 'required|in:O,C',
        ]);

        OperationJobMaster::whereIn('id', $request->selected_jobs)
            ->where('company_id', $this->company_id)
            ->update(['job_status' => $request->job_status]);

        return redirect()->back()->with('success', 'Selected jobs updated successfully.');
    }

    public function filter(Request $request)
    {
        $query = OperationJobMaster::where('company_id', $this->company_id);

        if ($request->filled('job_no')) {
            $query->where('job_no', $request->job_no);
        }

        if ($request->filled('job_party_id')) {
            $query->where('job_party_id', $request->job_party_id);
        }

        $job_masters = $query->get();

        $html = '';

        foreach ($job_masters as $job_master) {
            switch ($job_master->job_activity) {
                case 'AIREXP.FWD':
                    $job_num = 'AE/' . $job_master->job_no . '/' . $job_master->created_at->format('Y');
                    $activity = 'AE';
                    break;
                case 'SEAIMP.FWD':
                    $job_num = 'SI/' . $job_master->job_no . '/' . $job_master->created_at->format('Y');
                    $activity = 'SI';
                    break;
                case 'SEAEXP.FWD':
                    $job_num = 'SE/' . $job_master->job_no . '/' . $job_master->created_at->format('Y');
                    $activity = 'SE';
                    break;
                default:
                    $job_num = 'AI/' . $job_master->job_no . '/' . $job_master->created_at->format('Y');
                    $activity = 'AI';
                    break;
            }

            $html .= '<tr>
                <td><input type="checkbox" name="selected_jobs[]" value="' . $job_master->id . '"></td>
                <td>' . $job_num . '</td>
                <td>' . $job_master->job_party->party_name . '</td>
                <td>' . $job_master->created_at->format('Y-m-d') . '</td>
                <td>' . $activity . '</td>
                <td>' . ($job_master->job_status == 'O' ? 'Open' : 'Close') . '</td>
            </tr>';
        }

        return response()->json([
            'status' => 'success',
            'result' => $html,
        ]);
    }

}
