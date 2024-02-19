<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectEmpPivot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i <= 5; $i++) { 
            DB::table('subject_emp')->insert(
                [
                    'subject_id' => Subject::all()->random()->id, 
                    'emp_id' => Employee::all()->random()->id, 
                ]
            );
        }
    }
}
