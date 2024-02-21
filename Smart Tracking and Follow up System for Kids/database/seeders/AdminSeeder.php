<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("admins")->insert([
            "email"=> "Rizk@admin.com",
            "password"=>bcrypt("123456")
        ]);
    }
}
//admin1 --------- Rizk@admin.com ----- 123456
//admin2 --------- Faten@admin.com ----- 456789