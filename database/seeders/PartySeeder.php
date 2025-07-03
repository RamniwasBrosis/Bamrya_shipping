<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MasterParty;

class PartySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partyTypes = [
            1 => 'Consignee',
            2 => 'Shipper',
            3 => 'CHA',
            4 => 'Overseas Agent',
            5 => 'Empty Yard',
            6 => 'Notify Party',
            7 => 'CFS Yard',
            8 => 'Shipping Line/Air Line',
            9 => 'Sales Person',
            10 => 'Billing Party',
            11 => 'PIC',
            14 => 'Overseas Agent',
            15 => 'Iata Agent',
            19 => 'Co-loader',
            21 => 'Surveyor',
        ];
        
        
        foreach ($partyTypes as $typeId => $typeName) {
            MasterParty::create([
                // 'party_code' => 'PTY' . str_pad($typeId, 3, '0', STR_PAD_LEFT),
                'party_name' => $typeName,
                'party_type' => $typeId,
                'status' => 1
            ]);
        }

    }
}
