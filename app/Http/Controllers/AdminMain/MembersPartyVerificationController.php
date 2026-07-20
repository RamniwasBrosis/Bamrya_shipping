<?php

namespace App\Http\Controllers\AdminMain;

use App\Models\MasterExportParty;
use App\Models\MasterImportParty;

use Illuminate\Http\Request;
use App\Models\MasterShipping;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MembersPartyVerificationController extends Controller
{
    public $company_id ;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->company_id = Auth::user()->company_id;
            $this->user_id = auth()->user()->id;
            return $next($request);
        });
    }
    
    public function shipperIndex(Request $request)
    {
        $record = DB::table('master_parties_enable_features')
            ->where('company_id', $this->company_id)
            ->whereNotNull('isShipper')
            ->first();
            
        $ShipperPartyLists = MasterExportParty::where('company_id', $this->company_id)->where('status', 1)->orderBy('party_name', 'asc')->paginate(25);
        return view('admin-main.admin.partyVerification.shipperParty', compact('record', 'ShipperPartyLists'));
    }
    
    public function shipperStore(Request $request)
    {
        $permission = $request->has('allow_without_docs') ? '1' : '0';
    
        $db_record = DB::table('master_parties_enable_features')
            ->where('company_id', $this->company_id)
            ->whereNotNull('isShipper')
            ->first();
    
        if ($db_record) {
    
            DB::table('master_parties_enable_features')
                ->where('company_id', $this->company_id)
                ->whereNotNull('isShipper')
                ->update([
                    'isFeatured' => $permission,
                    'updated_at' => now(),
                ]);
    
        } else {
    
            DB::table('master_parties_enable_features')->insert([
                'company_id' => $this->company_id,
                'uuid'       => (string) Str::uuid(),
                'isShipper'  => 1,
                'isFeatured'=> $permission,
                'created_at'=> now(),
                'updated_at'=> now(),
            ]);
        }
    
        return redirect()->back()->with('success', 'Permission updated successfully.');
    }


    public function otherIndex(Request $request)
    {
        $record = DB::table('master_parties_enable_features')
            ->where('company_id', $this->company_id)
            ->whereNotNull('isOtherParties')
            ->first();
            
        $OtherPartyLists = MasterImportParty::where('company_id', $this->company_id)->where('status', 1)->orderBy('party_name', 'asc')->paginate(25);
        return view('admin-main.admin.partyVerification.otherParty', compact('record', 'OtherPartyLists'));
    }
    
    public function otherPartyStore(Request $request)
    {
        $permission = $request->has('allow_without_docs') ? '1' : '0';
    
        $db_record = DB::table('master_parties_enable_features')
            ->where('company_id', $this->company_id)
            ->whereNotNull('isOtherParties')
            ->first();
    
        if ($db_record) {
    
            DB::table('master_parties_enable_features')
                ->where('company_id', $this->company_id)
                ->whereNotNull('isOtherParties')
                ->update([
                    'isFeatured' => $permission,
                    'updated_at' => now(),
                ]);
    
        } else {
    
            DB::table('master_parties_enable_features')->insert([
                'company_id' => $this->company_id,
                'uuid'       => (string) Str::uuid(),
                'isOtherParties'  => 1,
                'isFeatured'=> $permission,
                'created_at'=> now(),
                'updated_at'=> now(),
            ]);
        }
    
        return redirect()->back()->with('success', 'Permission updated successfully.');
    }
    
    
    public function downloadPartyDocument($id)
    {
        $party = MasterExportParty::findOrFail($id); 
        // or MasterExportParty based on your logic
    
        if (!$party->document) {
            abort(404, 'Document not found');
        }
    
        if (!Storage::disk('public')->exists($party->document)) {
            abort(404, 'File missing on server');
        }
    
        return Storage::disk('public')->download($party->document);
    }
    
    public function partyApprovalPermission(Request $request, $id)
    {
        $approval= $request->has('approval_status') ? '1' : '0';
        
        if($request->party_type == 'shipperParty'){
            $shipperParty = MasterExportParty::find($id); 
            
        }else{
            $shipperParty = MasterImportParty::find($id); 
        }
        
        
        if($shipperParty){
            $shipperParty->approval = $approval;
            $shipperParty->approved_by = $this->user_id;
            $shipperParty->save();
            
            return redirect()->back()->with('success', 'Approval Permission updated successfully.');
        }
        
        return redirect()->back()->with('success', 'Approval Permission Not updated.');
        
    }

    
}
