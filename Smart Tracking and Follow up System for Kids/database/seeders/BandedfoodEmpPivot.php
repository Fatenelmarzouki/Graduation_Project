<?php

namespace Database\Seeders;

use App\Models\Bandedfood;
use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BandedfoodEmpPivot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i <= 5; $i++) { 
            DB::table('bandedfood_emp')->insert(
                [
                    'bandedfood_id' => Bandedfood::all()->random()->id, 
                    'emp_id' => Employee::all()->random()->id, 
                ]
            );
        }
    }
}
