<?php

namespace Database\Seeders;

use App\Models\Father;
use App\Models\Food;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FatherFoodPivot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i <= 5; $i++) { 
            DB::table('father_food')->insert(
                [
                    'father_id' => Father::all()->random()->id, 
                    'food_id' => Food::all()->random()->id, 
                ]
            );
        }
    }
}
