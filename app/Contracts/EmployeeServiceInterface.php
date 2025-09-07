<?php
namespace App\Contracts;

use App\Models\Employee;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

interface EmployeeServiceInterface
{
    public function getAllEmployees(): array;
    public function getPaginatedEmployees(Request $request): LengthAwarePaginator;
    public function getEmployeeById(int $id): ?Employee;
    public function createEmployee(array $data): Employee;
    public function updateEmployee(Employee $employee, array $data): Employee;
    public function deleteEmployee(Employee $employee): bool;
    public function searchEmployees(string $query): array;
    public function filterEmployeesByDepartment(int $departmentId): array;
    public function getEmployeesWithFilters(Request $request): array;
}
