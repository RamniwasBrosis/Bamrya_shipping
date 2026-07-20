<?php

namespace App\Http\Controllers\AdminMain\Tally;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TallyPrime\TallyVoucher;
use App\Helper\TallyXmlParser;
use Illuminate\Support\Str;

class TallySyncController extends Controller
{
    // public $company_id ;

    // public function __construct(){
    //     $this->middleware(function ($request, $next) {
    //         $this->company_id = Auth::user()->company_id;
    //         return $next($request);
    //     });
    // }
    
    public function sync(Request $request)
    {
        if ($request->header('X-TALLY-TOKEN') !== config('services.tally.token')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        $xml = base64_decode($request->xml);
    
        $vouchers = TallyXmlParser::parseVouchers($xml);
        
        $incomingGuids = [];
        foreach ($vouchers as $data) {
        
            $incomingGuids[] = $data['voucher_guid'];
        
            $existing = TallyVoucher::where('voucher_guid', $data['voucher_guid'])->first();
        
            if ($existing && $data['alter_id'] <= $existing->alter_id) {
                continue;
            }
        
            TallyVoucher::updateOrCreate(
                ['voucher_guid' => $data['voucher_guid']],
                [
                    'company_id'        => 2,
                    'uuid'              => $existing?->uuid ?? (string) \Str::uuid(),
                    'client_id'         => 1,
                    'tally_company_id'  => 1,
                    'alter_id'          => $data['alter_id'],
                    'voucher_type'      => $data['voucher_type'],
                    'voucher_no'        => $data['voucher_no'],
                    'voucher_date'      => $data['voucher_date'],
                    'party_name'        => $data['party_name'],
                    'amount'            => $data['amount'],
                    'is_deleted'        => false,
                    'synced_at'         => now(),
                ]
            );
        }
        
        if (!empty($incomingGuids)) {
            TallyVoucher::where('company_id', 2)
                ->where('client_id', 1)
                ->where('tally_company_id', 1)
                ->whereNotIn('voucher_guid', $incomingGuids)
                ->update([
                    'is_deleted' => true,
                    'synced_at' => now()
                ]);
        }
    
        return response()->json([
            'status' => 'ok',
            'count'  => count($vouchers)
        ]);
    }
    
    public function salesInvoices()
    {
        return TallyVoucher::where('voucher_type', 'Sales')
            ->where('is_deleted', false)
            ->latest('voucher_date')
            ->paginate(20);
    }
}
