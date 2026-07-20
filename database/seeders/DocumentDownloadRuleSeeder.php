<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocumentDownloadRule;
use Illuminate\Support\Facades\Auth;

class DocumentDownloadRuleSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Remove old rules
        DocumentDownloadRule::truncate();

        $companyId = 2; // Change if required

        $rules = [

            /*
            |--------------------------------------------------------------------------
            | AIR IMPORT - MAWB
            |--------------------------------------------------------------------------
            */
            ['company_id'=>$companyId,'module'=>'air_import','document_type'=>'mawb','copy_type'=>'ORIGINAL 1 (FOR ISSUING CARRIER)','max_download'=>3],
            ['company_id'=>$companyId,'module'=>'air_import','document_type'=>'mawb','copy_type'=>'ORIGINAL 2 (FOR CONSIGNEE)','max_download'=>3],
            ['company_id'=>$companyId,'module'=>'air_import','document_type'=>'mawb','copy_type'=>'ORIGINAL 3 (FOR SHIPPER)','max_download'=>3],

            ['company_id'=>$companyId,'module'=>'air_import','document_type'=>'mawb','copy_type'=>'COPY 4 (DELIVERY RECEIPT)','max_download'=>null],
            ['company_id'=>$companyId,'module'=>'air_import','document_type'=>'mawb','copy_type'=>'COPY 5 (FOR AIRPORT OF DESTINATION)','max_download'=>null],
            ['company_id'=>$companyId,'module'=>'air_import','document_type'=>'mawb','copy_type'=>'COPY 6 (FOR THIRD CARRIER)','max_download'=>null],
            ['company_id'=>$companyId,'module'=>'air_import','document_type'=>'mawb','copy_type'=>'COPY 9 (FOR AGENT)','max_download'=>null],
            ['company_id'=>$companyId,'module'=>'air_import','document_type'=>'mawb','copy_type'=>'COPY 10 (EXTRA COPY FOR CARRIER)','max_download'=>null],
            /*
            |--------------------------------------------------------------------------
            | AIR IMPORT - HAWB
            |--------------------------------------------------------------------------
            */
            ['company_id'=>$companyId,'module'=>'air_import','document_type'=>'hawb','copy_type'=>'ORIGINAL 1 (FOR ISSUING CARRIER)','max_download'=>3],
            ['company_id'=>$companyId,'module'=>'air_import','document_type'=>'hawb','copy_type'=>'ORIGINAL 2 (FOR CONSIGNEE)','max_download'=>3],
            ['company_id'=>$companyId,'module'=>'air_import','document_type'=>'hawb','copy_type'=>'ORIGINAL 3 (FOR SHIPPER)','max_download'=>3],
            ['company_id'=>$companyId,'module'=>'air_import','document_type'=>'hawb','copy_type'=>'COPY 4 (DELIVERY RECEIPT)','max_download'=>null],
            ['company_id'=>$companyId,'module'=>'air_import','document_type'=>'hawb','copy_type'=>'COPY 5 (FOR AIRPORT OF DESTINATION)','max_download'=>null],
            ['company_id'=>$companyId,'module'=>'air_import','document_type'=>'hawb','copy_type'=>'COPY 6 (FOR THIRD CARRIER)','max_download'=>null],
            ['company_id'=>$companyId,'module'=>'air_import','document_type'=>'hawb','copy_type'=>'COPY 9 (FOR AGENT)','max_download'=>null],
            ['company_id'=>$companyId,'module'=>'air_import','document_type'=>'hawb','copy_type'=>'COPY 10 (EXTRA COPY FOR CARRIER)','max_download'=>null],
            // air export mawb
            ['company_id'=>$companyId,'module'=>'air_export','document_type'=>'mawb','copy_type'=>'ORIGINAL 1 (FOR ISSUING CARRIER)','max_download'=>3],
            ['company_id'=>$companyId,'module'=>'air_export','document_type'=>'mawb','copy_type'=>'ORIGINAL 2 (FOR CONSIGNEE)','max_download'=>3],
            ['company_id'=>$companyId,'module'=>'air_export','document_type'=>'mawb','copy_type'=>'ORIGINAL 3 (FOR SHIPPER)','max_download'=>3],
            ['company_id'=>$companyId,'module'=>'air_export','document_type'=>'mawb','copy_type'=>'COPY 4 (DELIVERY RECEIPT)','max_download'=>null],
            ['company_id'=>$companyId,'module'=>'air_export','document_type'=>'mawb','copy_type'=>'COPY 5 (FOR AIRPORT OF DESTINATION)','max_download'=>null],
            ['company_id'=>$companyId,'module'=>'air_export','document_type'=>'mawb','copy_type'=>'COPY 6 (FOR THIRD CARRIER)','max_download'=>null],
            ['company_id'=>$companyId,'module'=>'air_export','document_type'=>'mawb','copy_type'=>'COPY 9 (FOR AGENT)','max_download'=>null],
            ['company_id'=>$companyId,'module'=>'air_export','document_type'=>'mawb','copy_type'=>'COPY 10 (EXTRA COPY FOR CARRIER)','max_download'=>null],
            // air export hawb
            ['company_id'=>$companyId,'module'=>'air_export','document_type'=>'hawb','copy_type'=>'ORIGINAL 1 (FOR ISSUING CARRIER)','max_download'=>3],
            ['company_id'=>$companyId,'module'=>'air_export','document_type'=>'hawb','copy_type'=>'ORIGINAL 2 (FOR CONSIGNEE)','max_download'=>3],
            ['company_id'=>$companyId,'module'=>'air_export','document_type'=>'hawb','copy_type'=>'ORIGINAL 3 (FOR SHIPPER)','max_download'=>3],
            ['company_id'=>$companyId,'module'=>'air_export','document_type'=>'hawb','copy_type'=>'COPY 4 (DELIVERY RECEIPT)','max_download'=>null],
            ['company_id'=>$companyId,'module'=>'air_export','document_type'=>'hawb','copy_type'=>'COPY 5 (FOR AIRPORT OF DESTINATION)','max_download'=>null],
            ['company_id'=>$companyId,'module'=>'air_export','document_type'=>'hawb','copy_type'=>'COPY 6 (FOR THIRD CARRIER)','max_download'=>null],
            ['company_id'=>$companyId,'module'=>'air_export','document_type'=>'hawb','copy_type'=>'COPY 9 (FOR AGENT)','max_download'=>null],
            ['company_id'=>$companyId,'module'=>'air_export','document_type'=>'hawb','copy_type'=>'COPY 10 (EXTRA COPY FOR CARRIER)','max_download'=>null],
            // sea-import bl 
            ['company_id'=>$companyId,'module'=>'sea_import','document_type'=>'mbl','copy_type'=>'ORIGINAL','max_download'=>3],
            ['company_id'=>$companyId,'module'=>'sea_import','document_type'=>'mbl','copy_type'=>'1st ORIGINAL','max_download'=>3],
            ['company_id'=>$companyId,'module'=>'sea_import','document_type'=>'mbl','copy_type'=>'2nd ORIGINAL','max_download'=>3],
            ['company_id'=>$companyId,'module'=>'sea_import','document_type'=>'mbl','copy_type'=>'3rd ORIGINAL','max_download'=>3],
            // sea-export bl
            ['company_id'=>$companyId,'module'=>'sea_export','document_type'=>'mbl','copy_type'=>'ORIGINAL','max_download'=>3],
            ['company_id'=>$companyId,'module'=>'sea_export','document_type'=>'mbl','copy_type'=>'1st ORIGINAL','max_download'=>3],
            ['company_id'=>$companyId,'module'=>'sea_export','document_type'=>'mbl','copy_type'=>'2nd ORIGINAL','max_download'=>3],
            ['company_id'=>$companyId,'module'=>'sea_export','document_type'=>'mbl','copy_type'=>'3rd ORIGINAL','max_download'=>3],
            
        ];

        foreach ($rules as $rule) {

            DocumentDownloadRule::create($rule);

        }
    }
}