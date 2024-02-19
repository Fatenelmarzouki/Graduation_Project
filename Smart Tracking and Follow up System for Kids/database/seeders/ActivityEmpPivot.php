<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivityEmpPivot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i <= 5; $i++) { 
            DB::table('activity_emp')->insert(
                [
                    'activity_id' => Activity::all()->random()->id, 
                    'emp_id' => Employee::all()->random()->id, 
                ]
            );
        }
    }
}
