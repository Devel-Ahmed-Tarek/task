<?php
namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = Department::all();

        $employees = [
            ['name' => 'John Doe', 'email' => 'john.doe@example.com', 'salary' => 75000],
            ['name' => 'Jane Smith', 'email' => 'jane.smith@example.com', 'salary' => 82000],
            ['name' => 'Mike Johnson', 'email' => 'mike.johnson@example.com', 'salary' => 68000],
            ['name' => 'Sarah Wilson', 'email' => 'sarah.wilson@example.com', 'salary' => 95000],
            ['name' => 'David Brown', 'email' => 'david.brown@example.com', 'salary' => 72000],
            ['name' => 'Lisa Davis', 'email' => 'lisa.davis@example.com', 'salary' => 88000],
            ['name' => 'Tom Miller', 'email' => 'tom.miller@example.com', 'salary' => 65000],
            ['name' => 'Amy Garcia', 'email' => 'amy.garcia@example.com', 'salary' => 78000],
            ['name' => 'Chris Rodriguez', 'email' => 'chris.rodriguez@example.com', 'salary' => 92000],
            ['name' => 'Emma Martinez', 'email' => 'emma.martinez@example.com', 'salary' => 71000],
            ['name' => 'Alex Thompson', 'email' => 'alex.thompson@example.com', 'salary' => 85000],
            ['name' => 'Olivia Anderson', 'email' => 'olivia.anderson@example.com', 'salary' => 76000],
            ['name' => 'James Taylor', 'email' => 'james.taylor@example.com', 'salary' => 69000],
            ['name' => 'Sophia Thomas', 'email' => 'sophia.thomas@example.com', 'salary' => 81000],
            ['name' => 'William Jackson', 'email' => 'william.jackson@example.com', 'salary' => 74000],
        ];

        foreach ($employees as $employeeData) {
            Employee::create([
                'name'          => $employeeData['name'],
                'email'         => $employeeData['email'],
                'department_id' => $departments->random()->id,
                'salary'        => $employeeData['salary'],
            ]);
        }
    }
}