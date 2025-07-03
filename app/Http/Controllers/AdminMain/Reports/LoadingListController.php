<?php

namespace App\Http\Controllers\AdminMain\Reports;

use App\Models\MasterPort;
use App\Models\MasterVessel;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Operations\OperationBooking;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LoadingListExport;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

class LoadingListController extends Controller
{

    public $company_id ;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->company_id = Auth::user()->company_id;
            return $next($request);
        });
    }
    
    public function index(){
        $vessels = MasterVessel::where('company_id', $this->company_id)->get();
        return view('admin-main.admin.loadingList.first', compact('vessels'));
    }

    public function preview(Request $request)
    {
        $query = OperationBooking::where('company_id', $this->company_id);

        $query->when($request->filled('vessel_id'), function ($q) use ($request){
            $q->where('vessel_id', 'LIKE', $request->vessel_id);
        });
        $query->when($request->filled('voy_no'), function ($q) use ($request){
            $q->orWhere('voy_no', 'LIKE', $request->voy_no);
        });
      

        $booking_lists = $query->orderBy('created_at', 'desc')->paginate(25);

        $html = '
            <h2 style="text-align: center;">DN SHIPPING & LOGISTICS</h2>
            <p style="text-align: center;">Plot No.14B, Sector -19, Opp. to Dana Bandar<br>
            APMC, Vashi, NaviMumbai - 400 705<br>
            Tel: +91 22 49705707 Email: akram@oecc.in<br>
            Website: www.oecc.in</p>';

        $html .=  '<hr>';

        $html .='
            <div class="d-flex justify-content-between">
                <div class="">
                    <h4>SUBJECT: LOADING LIST</h4>
                    <p><strong>VESSEL:</strong>'. '' .'</p>
                    <p><strong>VOY:</strong>'. '' .'</p>
                    <p><strong>TERMINAL PORT:</strong>'.''.'</p>
                </div>
                <div>
                    <div class="dropdown mb-3">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Download
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="'.route('loading-list.download', ['format' => 'pdf']).'" target="_blank">Download PDF</a></li>
                            <li><a class="dropdown-item" href="'.route('loading-list.download', ['format' => 'excel']) .'" target="_blank">Download Excel</a></li>
                            <li><a class="dropdown-item" href="'.route('loading-list.download', ['format' => 'word']) .'" target="_blank">Download Word</a></li>
                        </ul>
                    </div>
                </div>
                
            </div>';

        $html .='<table border="1" width="100%" cellspacing="0" cellpadding="5" class="table">
                <thead>
                    <tr>
                        <th>Booking No</th>
                        <th>Container No</th>
                        <th>Cont Size</th>
                        <th>Type</th>
                        <th>VGM WT</th>
                        <th>POL</th>
                        <th>POD</th>
                        <th>TEM</th>
                        <th>Remark (Hum & Vent)</th>
                        <th>Commodity</th>
                    </tr>
                </thead>
                <tbody>';
                    foreach ($booking_lists as $item) {
                        $html .='<tr>
                            <td>'. $item->booking_no .'</td>
                            <td>'. $item->container_no .'</td>
                            <td>'. $item->size .'</td>
                            <td>'. $item->cont_category .'</td>
                            <td>'. $item->vgm_wt .'</td>
                            <td>'. $item->port_loading_id  .'</td>
                            <td>'. $item->port_discharge_id .'</td>
                            <td>'. $item->tem .'</td>
                            <td>'. $item->remark .'</td>
                            <td>'. $item->commodity .'</td>
                        </tr>';
                    }
                    
                    
        $html .='</tbody>
            </table>';

        return response()->json(['html' => $html]);
    }

    public function download($format)
    {
        $query = OperationBooking::where('company_id', $this->company_id)->get();

        if ($format == 'pdf') {
            $html = View::make('admin-main.admin.LoadingList.loading-list', compact('query'))->render();

            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            return response($dompdf->output(), 200)
                    ->header('Content-Type', 'application/pdf')
                    ->header('Content-Disposition', 'attachment; filename="loading-list.pdf"');
        }

        if ($format == 'excel') {
            return Excel::download(new LoadingListExport($query), 'loading-list.xlsx');
        }

        if ($format == 'word') {
            $html = View::make('admin-main.admin.LoadingList.loading-list', compact('query'))->render();
            return response($html)
                ->header('Content-Type', 'application/msword')
                ->header('Content-Disposition', 'attachment; filename="loading-list.doc"');
        }

        return redirect()->back()->with('error', 'Invalid format selected');
    }


    // public function exportToPdf(Request $request)
    // {
    //     $data =  OperationBooking::where('vessel_id', $request->vessel_id)
    //         ->whereHas('voyage', function($q) use ($request) {
    //             $q->where('voy_no', $request->voy_no);
    //         })
    //         ->where('terminal_port_id', MasterPort::where('name', $request->terminal_port)->first()->id)
    //         ->get();

    //     $pdf = Pdf::loadView('reports.loading-list', compact('data'));

    //     return $pdf->download('loading-list.pdf');
    // }

}
