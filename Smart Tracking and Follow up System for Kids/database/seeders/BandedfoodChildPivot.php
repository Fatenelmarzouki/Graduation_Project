<?php

namespace Database\Seeders;

use App\Models\Bandedfood;
use App\Models\Child;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BandedfoodChildPivot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i <= 5; $i++) { 
            DB::table('bandedfood_child')->insert(
                [
                    'bandedfood_id' => Bandedfood::all()->random()->id, 
                    'child_id' => Child::all()->random()->id, 
                ]
            );
        }
    }
}
