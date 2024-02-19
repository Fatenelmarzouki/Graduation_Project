<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Food;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeFoodPivot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i <= 5; $i++) { 
            DB::table('emp_food')->insert(
                [
                    'emp_id' => Employee::all()->random()->id, 
                    'food_id' => Food::all()->random()->id, 
                ]
            );
        }
    }
}
