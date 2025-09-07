<?php
namespace App\Contracts;

use App\Models\Employee;

interface LoggingServiceInterface
{
    public function logEmployeeCreated(Employee $employee): void;
    public function logEmployeeUpdated(Employee $employee, array $oldData): void;
    public function logEmployeeDeleted(array $employeeData): void;
    public function logApiOperation(string $operation, array $data): void;
}
