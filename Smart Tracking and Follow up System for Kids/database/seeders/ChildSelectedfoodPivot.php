<?php

namespace Database\Seeders;

use App\Models\Child;
use App\Models\Selectedfood;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChildSelectedfoodPivot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i <= 5; $i++) { 
            DB::table('child_selectedfood')->insert(
                [
                    'selected_food_id' => Selectedfood::all()->random()->id, 
                    'child_id' => Child::all()->random()->id, 
                ]
            );
        }
    }
}
