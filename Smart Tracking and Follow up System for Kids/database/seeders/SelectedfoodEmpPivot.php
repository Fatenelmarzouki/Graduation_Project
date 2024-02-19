<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Selectedfood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SelectedfoodEmpPivot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i <= 5; $i++) { 
            DB::table('selectedfood_emp')->insert(
                [
                    'selected_food_id' => Selectedfood::all()->random()->id, 
                    'emp_id' => Employee::all()->random()->id, 
                ]
            );
        }
    }
}
