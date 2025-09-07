<?php
namespace App\Services;

use App\Contracts\LoggingServiceInterface;
use App\Models\Employee;
use Illuminate\Support\Facades\Log;

class LoggingService implements LoggingServiceInterface
{
    public function logEmployeeCreated(Employee $employee): void
    {
        Log::info('Employee created', [
            'employee_id'   => $employee->id,
            'name'          => $employee->name,
            'email'         => $employee->email,
            'department_id' => $employee->department_id,
            'salary'        => $employee->salary,
            'timestamp'     => now(),
        ]);
    }

    public function logEmployeeUpdated(Employee $employee, array $oldData): void
    {
        Log::info('Employee updated', [
            'employee_id' => $employee->id,
            'old_data'    => $oldData,
            'new_data'    => $employee->toArray(),
            'timestamp'   => now(),
        ]);
    }

    public function logEmployeeDeleted(array $employeeData): void
    {
        Log::info('Employee deleted', [
            'employee_id'   => $employeeData['id'],
            'name'          => $employeeData['name'],
            'email'         => $employeeData['email'],
            'department_id' => $employeeData['department_id'],
            'salary'        => $employeeData['salary'],
            'timestamp'     => now(),
        ]);
    }

    public function logApiOperation(string $operation, array $data): void
    {
        Log::info("Employee {$operation} via API", [
            'operation' => $operation,
            'data'      => $data,
            'timestamp' => now(),
        ]);
    }
}
