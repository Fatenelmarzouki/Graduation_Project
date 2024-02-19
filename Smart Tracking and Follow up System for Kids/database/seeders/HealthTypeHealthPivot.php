<?php

namespace Database\Seeders;

use App\Models\Health;
use App\Models\Healthdatasettype;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HealthTypeHealthPivot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i <= 5; $i++) { 
            DB::table('healthdatasettype_health')->insert(
                [
                    'health_id' => Health::all()->random()->id, 
                    'healthdatasettype_id' => Healthdatasettype::all()->random()->id, 
                ]
            );
        }
    }
    
}
