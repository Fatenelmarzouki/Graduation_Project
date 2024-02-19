<?php

namespace Database\Seeders;

use App\Models\Child;
use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpChildPivot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i <= 5; $i++) { 
            DB::table('child_emp')->insert(
                [
                    'child_id' => Child::all()->random()->id, 
                    'emp_id' => Employee::all()->random()->id, 
                ]
            );
        }
    }
}
