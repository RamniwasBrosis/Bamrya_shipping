<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Operations\OperationAirImport;
use App\Models\Operations\OperationAirExport;
use App\Models\Operations\OperationSeaImport;
use App\Models\Operations\OperationSeaExport;

class ViewServiceProvider extends ServiceProvider 
{
    public function boot() 
    {
        // Passing data to header globally
        View::composer('admin-main.elements.header', function ($view) {
            // Check if user is authenticated
            if (!Auth::check()) {
                $view->with('headerData', collect()); // Return empty collection
                return;
            }

            $company_id = Auth::user()->company_id;

            // Get air import records with missing dates
            $airImports = OperationAirImport::where('company_id', $company_id)
                ->where(function($query) {
                    $query->whereNull('eta_date')
                          ->orWhereNull('etd_date')
                          ->orWhereNull('out_off_charge_date')
                          ->orWhereNull('check_list_date');
                })->get();

            // Get air export records with missing dates
            $airExports = OperationAirExport::where('company_id', $company_id)
                ->where(function($query) {
                    $query->whereNull('eta_date')
                          ->orWhereNull('etd_date')
                          ->orWhereNull('leo_date')
                          ->orWhereNull('check_list_date')
                          ->orWhereNull('cartining_date');
                })->get();

            // Combine both collections
            $data = $airImports->merge($airExports);
            
            // echo "<pre>"; print_r($data); exit();

            $view->with('headerData', $data);
        });
    }
}
