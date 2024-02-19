<?php

namespace Database\Seeders;

use App\Models\Health;
use App\Models\Healthdatasetname;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HealthNameHealthPivot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i <= 5; $i++) { 
            DB::table('healthdatasetname_health')->insert(
                [
                    'health_id' => Health::all()->random()->id, 
                    'healthdatasetname_id' => Healthdatasetname::all()->random()->id, 
                ]
            );
        }
    }
}
