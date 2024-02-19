<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Activity;
use App\Models\AddHealth;
use App\Models\Attendence;
use App\Models\Bandedfood;
use App\Models\Child;
use App\Models\Employee;
use App\Models\Father;
use App\Models\Food;
use App\Models\Health;
use App\Models\Healthdatasetname;
use App\Models\Healthdatasettype;
use App\Models\HealthReport;
use App\Models\Issue;
use App\Models\Post;
use App\Models\Selectedfood;
use App\Models\Subject;
use App\Models\SubjectReport;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // 1: insert in admin

        // 2: insert data in subjectdataset
        /*INSERT INTO `subjectdataset` (`name`, `admin_id`) VALUES ('Arabic', '1'), ('English', '1'), ('Math', '1'), ('History', '1'), ('Science', '1'), ('Geography', '1'), ('Computer', '1'); */

        // 3: insert data in activitydataset
        /*insert into `activitydataset` (`name`,`admin_id`) values ('Artistic', '1'), ('Cultural', '1'), ('Athletic', '1'), ('Social', '1'), ('Scientific', '1'); */

        // Employee::factory(10)->create();
        // Father::factory(10)->create();
        // Child::factory(10)->create();
        // Activity::factory(10)->create();
        // Subject::factory(10)->create();
        // Food::factory(8)->create();
        // Health::factory(2)->create();
        // Selectedfood::factory(8)->create();
        // HealthReport::factory(3)->create();
        // SubjectReport::factory(3)->create();
        // Healthdatasetname::factory(4)->create();
        // Healthdatasettype::factory(12)->create();
        // Attendence::factory(10)->create();
        // Post::factory(2)->create();
        // Issue::factory(2)->create();
        // AddHealth::factory(3)->create();
        // Bandedfood::factory(10)->create();


        // $this->call([
            // ActivityEmpPivot::class,
            // ChildSelectedfoodPivot::class,
            // ChildSubjectPivot::class,
            // EmpChildPivot::class,
            // EmployeeFoodPivot::class,
            // FatherFoodPivot::class,
            // HealthEmpPivot::class,
            // HealthNameHealthPivot::class,
            // HealthTypeHealthPivot::class,
            // SelectedfoodEmpPivot::class,
            // SelectedfoodFatherPivot::class,
            // SubjectEmpPivot::class,
            // BandedfoodEmpPivot::class,
            // BandedfoodChildPivot::class,
        // ]);

        //Done
    }
}
//php artisan db:seed --class=ActivityEmpPivot
//php artisan db:seed --class=ChildSelectedfoodPivot
//php artisan db:seed --class=ChildSubjectPivot
//php artisan db:seed --class=EmpChildPivot
//php artisan db:seed --class=EmployeeFoodPivot

//php artisan db:seed --class=FatherFoodPivot
//php artisan db:seed --class=FatherHealthNamePivot
//php artisan db:seed --class=FatherHealthTypePivot
//php artisan db:seed --class=HealthEmpPivot
//php artisan db:seed --class=HealthNameHealthPivot
//php artisan db:seed --class=HealthTypeHealthPivot


//php artisan db:seed --class=SelectedfoodEmpPivot
//php artisan db:seed --class=SelectedfoodFatherPivot
//php artisan db:seed --class=SubjectEmpPivot