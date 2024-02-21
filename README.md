
# Smart Tracking and Follow up System for Kids

Navigating today's educational landscape can pose challenges for students managing health issues. Finding optimal ways to safeguard their well-being is a common struggle among parents and school personnel, often resulting in a tumultuous school experience. Our solution offers a comprehensive system uniting parents, students, and school staff in a single platform. To realize this vision, we've merged smartwatch technology with a mobile application. This integration empowers smartwatches to swiftly dispatch alerts to both parents and the school, ensuring prompt action during critical situations.

## Table of Contents
* Installation
* Usage
* Features
* Technologies Used
* License

## Installation
1. clone this repo to your local machine: 

```bash
git clone https://github.com/Fatenelmarzouki/Graduation_Project.git && cd Graduation_Project
```
2. Run `composer install`

## Usage
1. Create a new database
2. Import the `final_project.sql` file from the `Database` directory into your new database you have created.
3. Rename or copy `.env.example` file to `.env`
4. Set your configuration settings in your `.env` file
5. Run `php artisan key:generate`
6. Run `php artisan serve`
7. Run `php artisan storage:link`
8. You can get the APIs Links From `api.php` file
9. You can access the Admin Loign page from `http://127.0.0.1:8000/login`
10. Credentials to access admin panel (email: `Rizk@admin.com`, password: `123456`)

## Features
* ### Parent Interface:
    * Provide real-time updates on their child's vital markers, study records, and health records.
    * Customize essential features to ensure their child's well-being.
    * Enable direct communication with social workers, saving time and effort.
    * Select the variety and amount of food accessible at the school for your child.
    * Monitor the Psychological health of their child

* ### School Staff Interface:
    * Monitor the Psychological health of the students 
    * Create organized data files and streamline management processes.
    * Provide real-time updates on their students' vital markers, study records, and health records.
    * Streamline and optimize all school operations, reducing both time and effort required.
    * Facilitate faster communication with parents.
    * Simplify the search for specific student data. reports
    * Facilitate the creation of comprehensive study and health reports for students.

## Technologies Used

**Front-End:** Flutter, Dart, HTML, CSS, JavaScript

**Back-End:** PHP, MySQL, Laravel

**Hardware Tools:** Samsung Galaxy Watch 4

## License
The Laravel framework is open-sourced software licensed under the [MIT License](https://choosealicense.com/licenses/mit/).









