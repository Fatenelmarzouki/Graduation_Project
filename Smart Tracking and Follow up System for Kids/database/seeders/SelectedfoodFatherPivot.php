<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Father;
use App\Models\Selectedfood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SelectedfoodFatherPivot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i <= 5; $i++) { 
            DB::table('selectedfood_father')->insert(
                [
                    'father_id' => Father::all()->random()->id, 
                    'selected_food_id' => Selectedfood::all()->random()->id, 
                ]
            );
        }
    }
}
