<?php

namespace Database\Seeders;

use App\Models\Child;
use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChildSubjectPivot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //child_subject
        for ($i=0; $i <= 5; $i++) { 
            DB::table('child_subject')->insert(
                [
                    'child_id' => Child::all()->random()->id, 
                    'subject_id' => Subject::all()->random()->id, 
                ]
            );
        }
    }
}
